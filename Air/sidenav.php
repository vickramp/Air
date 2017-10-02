<aside id="left-sidebar-nav">
    <ul id="slide-out" class="side-nav fixed leftside-navigation">
        <li class="user-details cyan darken-2">
            <div class="row">
                <div class="col col s4 m4 l4" >
                    <img class="circle responsive-img valign profile-image " src="/Air/config/picture" />
                  </div>
                <div class="col col s8 m8 l8">
                    <ul id="profile-dropdown" class="dropdown-content">
                        <li><a style="padding-top: 15px"  href="/Air/users/profile"><i class="mdi-action-face-unlock"></i> Profile</a>
                        </li>
                        <li class="divider"></li>

                        <li><a style="padding-top: 15px" href="/Air/users/signout"><i class="mdi-hardware-keyboard-tab"></i> Logout</a>
                        </li>
                    </ul>
                    <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown"><?php echo name();?><i class="mdi-navigation-arrow-drop-down right"></i></a>
                    <p class="user-roal"><?php echo type();?></p>
                </div>
            </div>
        </li>
        <li class="bold" id="dashboard"><a href="/Air" class="waves-effect waves-cyan"><i class="mdi-action-dashboard"></i> Dashboard</a>
        </li>
        <ul class="collapsible collapsible-accordion">

        <li class="bold" ><a id="coursesa" href="/Air/courses" class="collapsible-header waves-effect waves-cyan"><i class="fa fa-graduation-cap"></i>Courses</a>
            <div class="collapsible-body">
                <ul>
                <?php
             require_once $_SERVER['DOCUMENT_ROOT'].'/Air/config/dbconfig.php';
              $db=connectDataBase('users');
              if(check(2))
                  $q='select id,course.courseid,name from course,assignedcourses  where course.courseid=assignedcourses.courseid and id in(select id from assignedcourses where staffid='.$_SESSION['userid'].')  order by id,courseid';
                  else
                    $q='select id,course.courseid,name from course,assignedcourses  where  course.courseid=assignedcourses.courseid and (assignedcourses.id in(select course_id from subject where studentid='.$_SESSION['userid'].') ) order by course.courseid ';
                    $res=$db->query($q);
                    $db->close();
                    while($ans=$res->fetch_assoc())
                    echo '    <li><a  href="?id='.$ans['id'].'"><i class="fa fa-book"></i>'.$ans['courseid'].' '.$ans['name'].'</a></li>';
        ?>
                </ul>
            </div>
        </li>

</ul>


<?php if(check(3))
echo '
        <li class="bold" id="editcourse"><a href="/Air/editcourses/" class="waves-effect waves-cyan"><i class="fa fa-edit"></i>Edit Courses</a>
        </li>
';
?>
<?php if(check(3))
echo '
        <li class="bold" id="assigncourse"><a href="/Air/assigncourses/" class="waves-effect waves-cyan"><i class="mdi-av-my-library-books"></i>Assign Courses</a>
        </li>
';
?>
<?php if(check(3))
echo '
        <li class="bold" id="groupstudents"><a href="/Air/groupstudents/" class="waves-effect waves-cyan"><i class="fa fa-users"></i>Group Students</a>
        </li>
';
?>


<!--
        <li class="bold"><a href="app-calendar.html" class="waves-effect waves-cyan"><i class="mdi-editor-insert-invitation"></i> Calender</a>
        </li>
        <li class="no-padding">
            <ul class="collapsible collapsible-accordion">
                <li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-action-invert-colors"></i> CSS</a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="css-typography.html">Typography</a>
                            </li>
                            <li><a href="css-icons.html">Icons</a>
                            </li>
                            <li><a href="css-shadow.html">Shadow</a>
                            </li>
                            <li><a href="css-media.html">Media</a>
                            </li>
                            <li><a href="css-sass.html">Sass</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="bold"><a href="app-widget.html" class="waves-effect waves-cyan"><i class="mdi-device-now-widgets"></i> Widgets <span class="new badge"></span></a>
                </li>
                <li class="bold"><a class="collapsible-header  waves-effect waves-cyan"><i class="mdi-editor-border-all"></i> Tables</a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="table-basic.html">Basic Tables</a>
                            </li>
                            <li><a href="table-data.html">Data Tables</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="bold"><a class="collapsible-header  waves-effect waves-cyan"><i class="mdi-editor-insert-comment"></i> Forms</a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="form-elements.html">Form Elements</a>
                            </li>
                            <li><a href="form-layouts.html">Form Layouts</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="bold"><a class="collapsible-header  waves-effect waves-cyan"><i class="mdi-social-pages"></i> Pages</a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="page-contact.html">Contact Page</a>
                            </li>
                            <li><a href="page-todo.html">ToDos</a>
                            </li>
                            <li><a href="page-blog-1.html">Blog Type 1</a>
                            </li>
                            <li><a href="page-blog-2.html">Blog Type 2</a>
                            </li>
                            <li><a href="page-404.html">404</a>
                            </li>
                            <li><a href="page-500.html">500</a>
                            </li>
                            <li><a href="page-blank.html">Blank</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="bold"><a class="collapsible-header  waves-effect waves-cyan"><i class="mdi-action-shopping-cart"></i> eCommers</a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="eCommerce-products-page.html">Products Page</a>
                            </li>
                            <li><a href="eCommerce-pricing.html">Pricing Table</a>
                            </li>
                            <li><a href="eCommerce-invoice.html">Invoice</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="bold"><a class="collapsible-header  waves-effect waves-cyan"><i class="mdi-image-image"></i> Medias</a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="media-gallary-page.html">Gallery Page</a>
                            </li>
                            <li><a href="media-hover-effects.html">Image Hover Effects</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="bold"><a class="collapsible-header  waves-effect waves-cyan"><i class="mdi-action-account-circle"></i> User</a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="user-profile-page.html">User Profile</a>
                            </li>
                            <li><a href="user-login.html">Login</a>
                            </li>
                            <li><a href="user-register.html">Register</a>
                            </li>
                            <li><a href="user-forgot-password.html">Forgot Password</a>
                            </li>
                            <li><a href="user-lock-screen.html">Lock Screen</a>
                            </li>
                            <li><a href="user-session-timeout.html">Session Timeout</a>
                            </li>
                        </ul>
                    </div>
                </li>

            </ul>
        </li>
        <li class="li-hover"><div class="divider"></div></li>
        <li class="li-hover"><p class="ultra-small margin more-text">MORE</p></li>
        <li><a href="css-grid.html"><i class="mdi-image-grid-on"></i> Grid</a>
        </li>
        <li><a href="css-color.html"><i class="mdi-editor-format-color-fill"></i> Color</a>
        </li>
        <li><a href="css-helpers.html"><i class="mdi-communication-live-help"></i> Helpers</a>
        </li>
        <li><a href="changelogs.html"><i class="mdi-action-swap-vert-circle"></i> Changelogs</a>
        </li>
        <li class="li-hover"><div class="divider"></div></li>
        <li class="li-hover"><p class="ultra-small margin more-text">Daily Sales</p></li>
        <li class="li-hover">
            <div class="row">
                <div class="col s12 m12 l12">
                    <div class="sample-chart-wrapper">
                        <div class="ct-chart ct-golden-section" id="ct2-chart"></div>
                    </div>
                </div>
            </div>
        </li>-->
    </ul>
    <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only cyan"><i class="mdi-navigation-menu"></i></a>
</aside>
