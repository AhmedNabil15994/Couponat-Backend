
                <div class="course-details__price">
                    <p class="course-details__price-amount">{{auth()->user()->name}} </p>
                    <a href="{{route("frontend.profile.edit")}}" class="thm-btn course-details__price-btn">@lang("Update Profile")</a>
                </div>
                <div class="course-details__meta">
                    <a href="{{route("frontend.profile.index")}}" class="course-details__meta-link active">
                        <span class="course-details__meta-icon">
                            <i class="far fa-user"></i>
                        </span>
                        @lang("Profile")
                    </a>
                    <a href="{{route("frontend.profile.edit")}}" class="course-details__meta-link ">
                        <span class="course-details__meta-icon">
                            <i class="far fa-clock"></i>
                        </span>
                        @lang("Update Profile")
                    </a>
                    <a href="{{route('frontend.profile.my-courses')}}" class="course-details__meta-link">
                        <span class="course-details__meta-icon">
                            <i class="far fa-folder-open"></i>
                        </span>
                        @lang("My Materials")
                    </a>
                    {{-- <a href="prints-files.php" class="course-details__meta-link">
                        <span class="course-details__meta-icon">
                            <i class="far fa-folder"></i>
                        </span>
                        @lang("My Notes")
                    </a> --}}
                    <a href="{{route('frontend.auth.logout')}}" class="course-details__meta-link">
                        <span class="course-details__meta-icon">
                            <i class="far fa-user-circle"></i>
                        </span>
                        @lang("Log out")
                    </a>
                </div>