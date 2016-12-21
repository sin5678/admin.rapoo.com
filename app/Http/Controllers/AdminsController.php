<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AbstractController as AbstractController;
use App\Http\Requests\AdminsRequest;
use App\Http\Requests\AdminsstoreRequest;
use App\Models\Role;
use App\Services\AdminsService;
use Illuminate\Http\Request;

class AdminsController extends AbstractController
{

    public function __construct(AdminsService $adminService)
    {
        parent::__construct();
        $this->adminService = $adminService;

    }

    /**
     * 列出主页
     *
     * @param
     */
    public function index()
    {
        $user_list = $this->adminService->getList();
        return view('admins.list')->with('user_list', $user_list);
    }

    /**
     * 添加页面
     *
     * @param
     */
    public function add()
    {
        $data['roles'] = Role::all();
        return view('admins.add', $data);
    }

    /**
     * 执行添加
     *
     * @param
     */
    public function save(AdminsRequest $request)
    {
        if ($this->adminService->createUser($request)) {
            return redirect('/admins')->withErrors('管理员创建完成');
        }
    }

    /**
     * 编辑页面
     *
     * @param
     */
    public function edit(Request $request)
    {
        $userInfo      = $this->adminService->getUser($request->id);
        $data['roles'] = Role::all();
        return view('admins.edit')->with(['data' => $data, 'admin_id' => $request->id, 'userInfo' => $userInfo]);
    }

    /**
     * 编辑保存
     *
     * @param
     */
    public function store(AdminsstoreRequest $request)
    {

        $userInfo = $this->adminService->getUser($request->admin_id);

        $re = $this->adminService->store($request);

        if ($re) {
            return redirect('/admins')->withErrors('修改完成');
        } else {
            return Redirect::to('/admins/edit');
        }
    }

    /**
     * 删除
     *
     * @param
     */
    public function delete(Request $request)
    {
        $userInfo = $this->adminService->delete($request->id);
        return redirect('/admins')->withErrors('删除完成');
    }

} //
