<header>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="assets/images/Couponat.svg" class="logo" alt="logo" />
            </a>
            <form class="d-flex mx-lg-auto">
                <input class="form-control rounded-pill" type="search" placeholder="ابدأ البحث الخاص بك" aria-label="Search">
                <button class="btn btn-info btn-search rounded-circle"  type="button" data-toggle="modal" data-target="#filter-modal">
                    <i class="bi bi-sliders"></i>
                </button>
            </form>
            <div class="collapse navbar-collapse pull-rigth" id="navbarScroll">
                <ul class="navbar-nav mr-auto my-2 my-lg-0 navbar-nav-scroll" style="max-height: 100px;">
                    <li class="nav-item cart-icon">
                        <a class="nav-link" href="cart.php">
                            <i class="bi bi-bag-fill"></i>
                            <span class="cart-num">2</span>
                        </a>
                    </li>
                    <li class="nav-item languege">
                        <a class="nav-link" href="#">
                            <i class="bi bi-globe"></i> English
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link  dropdown-toggle border rounded-pill" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-list"></i>
                            <img src="assets/images/user.png">
                        </a>
                         <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="signup.php" >تسجيل جديد</a></li>
                            <li><a class="dropdown-item" href="login.php" >تسجيل دخول</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="wishlists.php">المفضلة</a></li>
                            <li><a class="dropdown-item" href="account-settings.php">الملف الشخصي</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="login.php">تسجيل خروج</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<main>
    <section class="filter-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="owl-carousel owl-theme ctg-main filter-active">
                                <a href="index.php" class="filter" data-filter="*">
                                    <img src="assets/images/icons/Yurts.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">الكل</span>
                                </a>
                                <a href="category.php" class="filter" data-filter=".f1">
                                    <img src="assets/images/icons/A-frames.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">إطارات</span>
                                </a>
                                <a href="category.php" class="filter" data-filter=".f2">
                                    <img src="assets/images/icons/Amazing pools.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">حمامات سباحة</span>
                                </a>
                                <a href="category.php" class="filter" data-filter=".f3">
                                    <img src="assets/images/icons/Amazing views.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">مناظر مذهلة</span>
                                </a>
                                <a href="category.php" class="filter" data-filter=".f4">
                                    <img src="assets/images/icons/Arctic.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">القطب الشمالي</span>
                                </a>
                                <a href="#" class="filter" data-filter=".f5">
                                    <img src="assets/images/icons/Barns.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">الحظائر</span>
                                </a>
                                <a href="#" class="filter" data-filter=".f7">
                                    <img src="assets/images/icons/Beachfront.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">شاطيء البحر</span>
                                </a>
                                <a href="#" class="filter" data-filter=".f8">
                                    <img src="assets/images/icons/Bed & breakfasts.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">المبيت والإفطار</span>
                                </a>
                                <a href="#" class="filter" data-filter=".f9">
                                    <img src="assets/images/icons/Boats.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">قوارب</span>
                                </a>
                                <a href="#" class="filter" data-filter=".f10">
                                    <img src="assets/images/icons/Cabins.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">كبائن</span>
                                </a>
                                <a href="#" class="filter" data-filter=".f11">
                                    <img src="assets/images/icons/Campers.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">المعسكر</span>
                                </a>
                                <a href="#" class="filter" data-filter=".f12">
                                    <img src="assets/images/icons/Camping.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">تخييم</span>
                                </a>
                                <a href="#" class="filter" data-filter=".f13">
                                    <img src="assets/images/icons/Casas particulares.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">تفاصيل كاساس</span>
                                </a>
                                <a href="#" class="filter" data-filter=".f14">
                                    <img src="assets/images/icons/Castles.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">القلاع</span>
                                </a>
                                <a href="#" class="filter" data-filter=".f15">
                                    <img src="assets/images/icons/Caves.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">الكهوف</span>
                                </a>
                                <a href="#" class="filter" data-filter=".f16">
                                    <img src="assets/images/icons/Chef's kitchens.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">مطابخ الشيف</span>
                                </a>
                                <a href="#" class="filter" data-filter=".f17">
                                    <img src="assets/images/icons/Containers.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">حاويات</span>
                                </a>
                                <a href="#" class="filter" data-filter=".f18">
                                    <img src="assets/images/icons/Countryside.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">الريف</span>
                                </a>
                                <a href="#" class="filter" data-filter=".f19">
                                    <img src="assets/images/icons/Creative spaces.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">مساحات إبداعية</span>
                                </a>
                                <a href="#" class="filter" data-filter=".f20">
                                    <img src="assets/images/icons/Cycladic homes.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">المنازل السيكلادية</span>
                                </a>
                                <a href="#" class="filter" data-filter=".f21">
                                    <img src="assets/images/icons/Dammusi.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">الدموسي</span>
                                </a>
                                <a href="#" class="filter" data-filter=".f22">
                                    <img src="assets/images/icons/Desert.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">صحراء</span>
                                </a>
                                <a href="#" class="filter" data-filter=".f23">
                                    <img src="assets/images/icons/Design.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">تصميم</span>
                                </a>
                                <a href="#" class="filter" data-filter=".f24">
                                    <img src="assets/images/icons/Domes.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">القباب</span>
                                </a>
                                <a href="#" class="filter" data-filter=".f25">
                                    <img src="assets/images/icons/Earth homes.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">منازل الأرض</span>
                                </a>
                                <a href="#" class="filter" data-filter=".f26">
                                    <img src="assets/images/icons/Farms.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">مزارع</span>
                                </a>
                                <a href="#" class="filter" data-filter=".f27">
                                    <img src="assets/images/icons/Golfing.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">لعب الجولف</span>
                                </a>
                                <a href="#" class="filter" data-filter=".f28">
                                    <img src="assets/images/icons/Grand pianos.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">البيانو الكبير</span>
                                </a>
                                <a href="#" class="filter" data-filter=".f29">
                                    <img src="assets/images/icons/Historical homes.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">المنازل التاريخية</span>
                                </a>
                                <a href="#" class="filter" data-filter=".f30">
                                    <img src="assets/images/icons/Houseboats.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">المراكب</span>
                                </a>
                                <a href="#" class="filter" data-filter=".f31">
                                    <img src="assets/images/icons/Iconic cities.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">مدن أيقونية</span>
                                </a>
                                <a href="#" class="filter" data-filter=".f32">
                                    <img src="assets/images/icons/Islands.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">جزر</span>
                                </a>
                                <a href="#" class="filter" data-filter=".f33">
                                    <img src="assets/images/icons/Lake.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">بحيرة</span>
                                </a>
                                <a href="#" class="filter" data-filter=".f34">
                                    <img src="assets/images/icons/Lakefront.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">واجهة البحيرة</span>
                                </a>
                                <a href="#" class="filter" data-filter=".f35">
                                    <img src="assets/images/icons/Luxe.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">لوكس</span>
                                </a>
                                <a href="#" class="filter" data-filter=".f36">
                                    <img src="assets/images/icons/Mansions.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">القصور</span>
                                </a>
                                <a href="#" class="filter" data-filter=".f37">
                                    <img src="assets/images/icons/Minsus.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">ناقص</span>
                                </a>
                                <a href="#" class="filter" data-filter=".f38">
                                    <img src="assets/images/icons/National parks.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">المتنزهات الوطنية</span>
                                </a>
                                <a href="#" class="filter" data-filter=".f39">
                                    <img src="assets/images/icons/Off-the-grid.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">خارج الشبكة</span>
                                </a>
                                <a href="#" class="filter" data-filter=".f41">
                                    <img src="assets/images/icons/Play.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">لعب</span>
                                </a>
                                <a href="#" class="filter" data-filter=".f42">
                                    <img src="assets/images/icons/Riads.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">الطرق</span>
                                </a>
                                <a href="#" class="filter" data-filter=".f43">
                                    <img src="assets/images/icons/rooms.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">غرف</span>
                                </a>
                                <a href="#" class="filter" data-filter=".f44">
                                    <img src="assets/images/icons/Ryokans.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">ريوكان</span>
                                </a>
                                <a href="#" class="filter" data-filter=".f45">
                                    <img src="assets/images/icons/Shepherd's huts.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">أكواخ الراعي</span>
                                </a>
                                <a href="#" class="filter" data-filter=".f46">
                                    <img src="assets/images/icons/Skiing.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">التزحلق</span>
                                </a>
                                <a href="#" class="filter" data-filter=".f47">
                                    <img src="assets/images/icons/Ski-inout.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">التزلج في الخارج</span>
                                </a>
                                <a href="#" class="filter" data-filter=".f48">
                                    <img src="assets/images/icons/Surfing.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">تصفح</span>
                                </a>
                                <a href="#" class="filter" data-filter=".f49">
                                    <img src="assets/images/icons/Tiny homes.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">منازل صغيرة</span>
                                </a>
                                <a href="#" class="filter" data-filter=".f50">
                                    <img src="assets/images/icons/Top of the world.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">قمة العالم</span>
                                </a>
                                <a href="#" class="filter" data-filter=".f51">
                                    <img src="assets/images/icons/Towers.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">أبراج</span>
                                </a>
                                <a href="#" class="filter" data-filter=".f52">
                                    <img src="assets/images/icons/Treehouses.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">بيوت الأشجار</span>
                                </a>
                                <a href="#" class="filter" data-filter=".f53">
                                    <img src="assets/images/icons/Trending.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">الشائع</span>
                                </a>
                                <a href="#" class="filter" data-filter=".f54">
                                    <img src="assets/images/icons/Tropical.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">استوائي</span>
                                </a>
                                <a href="#" class="filter" data-filter=".f55">
                                    <img src="assets/images/icons/Trulli.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">ترولي</span>
                                </a>
                                <a href="#" class="filter" data-filter=".f56">
                                    <img src="assets/images/icons/Windmills.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">طواحين الهواء</span>
                                </a>
                                <a href="#" class="filter" data-filter=".f57">
                                    <img src="assets/images/icons/Yurts.jpg" class="icon-filter" alt="icon" />
                                    <span class="d-block">الخيام</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
