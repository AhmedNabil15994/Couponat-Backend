
@inject('roles', 'Modules\Authorization\Repositories\Dashboard\RoleRepository')
{!! field()->text('name',__('user::dashboard.admins.create.form.name'))!!}
{!! field()->email('email',__('user::dashboard.admins.create.form.email'))!!}
{!! field()->text('mobile',__('user::dashboard.admins.create.form.mobile'))!!}
{!! field()->password('password',__('user::dashboard.admins.create.form.password'))!!}
{!! field()->password('confirm_password',__('user::dashboard.admins.create.form.confirm_password'))!!}
{!! field()->file('image',__('user::dashboard.admins.create.form.image'),$model?$model->getFirstMediaUrl('images'):'')!!}

<div class="form-group">
    <label class="col-md-2">
        {{__('user::dashboard.admins.create.form.roles')}}
    </label>
    <div class="col-md-9">
        <div class="mt-checkbox-list">
            @foreach ($roles->getAllAdminsRoles('id', 'asc') as $role)
            <label class="mt-checkbox">
                <input type="checkbox"
                    name="roles[]"
                    @if(
                    optional($model)->hasRole($role->name))
                checked
                @endif
                value="{{$role->id}}">
                {{$role->display_name}}
                <span></span>
            </label>
            @endforeach
        </div>
    </div>
</div>
