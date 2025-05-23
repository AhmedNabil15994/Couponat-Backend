
{!! field()->text('name',__('user::vendor.admins.create.form.name'))!!}
{!! field()->email('email',__('user::vendor.admins.create.form.email'))!!}
{!! field()->text('mobile',__('user::vendor.admins.create.form.mobile'))!!}
{!! field()->password('password',__('user::vendor.admins.create.form.password'))!!}
{!! field()->password('confirm_password',__('user::vendor.admins.create.form.confirm_password'))!!}
{!! field()->file('image',__('user::vendor.admins.create.form.image'),$model?$model->getFirstMediaUrl('image'):'')!!}
