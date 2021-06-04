<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Helpers\DateHelper;
use App\Helpers\ImageHelper;
use App\Helpers\UploadHelper;
use App\Http\Controllers\Controller;
use App\Jobs\SendNotificationSystem;
use App\Models\Notification;
use App\Models\NotificationUser;
use App\Modules\Admin\Http\Requests\Notification\CreateNotificationRequest;
use App\Modules\Admin\Http\Requests\Notification\UpdateNotificationRequest;
use App\Repositories\Facades\NotificationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class NotificationController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = NotificationRepository::datatables($request->all())->withTrashed();
            return DataTables::of($query)
                ->addColumn('action', function ($model) {
                    $arrBtn = [];

                    $arrBtn['edit'] = route('admin.notifications.edit', $model->id);
                    if ($model->trashed()) {
                        $arrBtn['recovery'] = route('admin.notifications.recovery', $model->id);
                    } else {
                        $arrBtn['delete'] = route('admin.notifications.destroy', $model->id);
                    }
                    return view('Admin::layouts.components.group-button', $arrBtn);
                })
                ->editColumn('is_sent', function ($model) {
                    return view("Admin::layouts.components.datatable-boolean", ['bool' => $model->is_sent]);
                })->editColumn('created_at', function ($model) {
                    return DateHelper::formatDate($model->created_at,DateHelper::timeFormat);
                })
                ->editColumn('image', function ($model) {
                    return view("Admin::layouts.components.image-datatables", ['url' => $model->image]);
                })
                ->rawColumns(['status', 'image_thumbnail', 'action'])
                ->make(true);
        }
        return view('Admin::notifications.index');
    }

    public function create()
    {
        $model = new Notification();
        return view('Admin::notifications.create', compact('model'));
    }


    public function store(CreateNotificationRequest $request)
    {
        $data = $request->all();
        DB::beginTransaction();
        try {
            $path = UploadHelper::uploadFromRequest('image', config('uploadpath.notification'));
            $thumbnail = ImageHelper::createImageThumbnail($path, config('uploadpath.notification'));
            $data['image'] = $path;
            $data['image_thumbnail'] = $thumbnail;
            if (!empty($data['is_sent']) && $data['is_sent'] == 'on') {
                $data['is_sent'] = true;
            }else{
                unset( $data['is_sent']);
            }
            $model = NotificationRepository::create($data);

            if (!empty($data['is_sent']) && $data['is_sent'] == 'on') {
                SendNotificationSystem::dispatch($model->id);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return $this->successResponse(true);
    }

    public function edit($id)
    {
        $model = NotificationRepository::findOrFail($id);
        return view('Admin::notifications.create', compact('model'));
    }

    public function update(UpdateNotificationRequest $request, $id)
    {
        $model = NotificationRepository::findOrFail($id);
        DB::beginTransaction();
        try {
            $data = $request->all();
            if (!empty($request->image)) {
                $path = UploadHelper::uploadFromRequest('image', config('uploadpath.notification'));
                $thumbnail = ImageHelper::createImageThumbnail($path, config('uploadpath.notification'));
                $data['image'] = $path;
                $data['image_thumbnail'] = $thumbnail;

                $oldModel = clone $model;
            }

            if (!empty($data['send']) && $data['send'] == 'on') {
                    $data['is_sent'] = true;
            }else{
                unset( $data['is_sent']);
            }
            $model = NotificationRepository::update($model, $data);

            if (!empty($data['is_sent']) && $data['is_sent'] == 'on') {
                SendNotificationSystem::dispatch($model->id);
            }
            if (!empty($oldModel)) {
                UploadHelper::delete($oldModel->image);
                UploadHelper::delete($oldModel->image_thumbnail);
            }

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return $this->successResponse(true);
    }

    public function destroy($id)
    {
        $model = NotificationRepository::findOrFail($id);
        DB::beginTransaction();
        try {
            $model->notificationUsers()->delete();
            NotificationRepository::delete($model);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return $this->successResponse(true);
    }

    public function recovery($id)
    {
        DB::beginTransaction();
        try {
            NotificationRepository::recovery($id);
            NotificationUser::where('notification_id', $id)->withTrashed()->restore();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;

        }
        return $this->successResponse(true);
    }

}
