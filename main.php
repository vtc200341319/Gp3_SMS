<?php
session_start();

if (empty($_SESSION['loginID'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>SMS - Menu</title>        
        <link rel="stylesheet" href="css/main.css">

    </head>

    <body>       
        <h1 class="en" lang="en">School Management System - Menu <span class="clock" id="clock"></h1>
        <h1 class="zh" lang="zh">學校管理系統 - 目錄 <span class="clock" id="clock1"></h1>

        <div class="lang-selector">            
            <label for="lang-select" ></label>           
            <select id="lang-select" onchange="changeLanguage()">
                <option value="en">English</option>
                <option value="zh">中文</option>
            </select>
        </div>
        <p class="en" lang="en">Click on the buttons inside the tabbed menu:</p>
        <p class="zh" lang="zh">請按選項菜單內的按鈕：</p>       


        <div class = "en" lang = "en">
            <div class = "tab">
                <button class = "tablinks active" data-target = "home"><img src = "img/icon/home.png" alt = "Home" width = "35" height = "35">&nbsp;
                    Home </button>
                <button class = "tablinks" data-target = "campus"><img src = "img/icon/campus.png" alt = "Campus area" width = "35" height = "35">&nbsp;
                    Campus area</button>
                <button class = "tablinks" data-target = "school"><img src = "img/icon/schoolCenter.png" alt = "School Centre" width = "35" height = "35">&nbsp;
                    Learning Centre</button>
                <?php
                if ($_SESSION['type'] == 'A') {
                    echo '<button class="tablinks" data-target="teacher"><img src="img/icon/class.png" alt="Teacher workshop" width="35" height="35">&nbsp;Teacher Work Place</button>';
                    echo '<button class="tablinks" data-target="admin"><img src="img/icon/admin.png" alt="Administration" width="35" height="35">&nbsp;Admin Management</button>';
                }
                ?>


                <div class = "profile">
                    <button class = "tablinks" data-target = "profile"><img src = "img/icon/profile.png" alt = "Profile" width = "35" height = "35">&nbsp;
                        Profile</button>
                    <button class = "tablinks" data-target = "logout" onclick = "logout()"><img src = "img/icon/logout.png" alt = "Logout" width = "35" height = "35" >&nbsp;
                        Logout</button>
                </div>
            </div>
        </div>

        <div class = "zh" lang = "zh">
            <div class = "tab">
                <button class = "tablinks active" data-target = "home"><img src = "img/icon/home.png" alt = "Home" width = "35" height = "35">&nbsp;
                    主頁 </button>
                <button class = "tablinks" data-target = "campus"><img src = "img/icon/campus.png" alt = "Campus area" width = "35" height = "35">&nbsp;
                    校園地帶</button>
                <button class = "tablinks" data-target = "school"><img src = "img/icon/schoolCenter.png" alt = "School Centre" width = "35" height = "35">&nbsp;
                    學習中心</button>
                <button class = "tablinks" data-target = "teacher"><img src = "img/icon/class.png" alt = "Teacher workshop" width = "35" height = "35">&nbsp;
                    老師工作間</button>
                <button class = "tablinks" data-target = "admin"><img src = "img/icon/admin.png" alt = "Administration" width = "35" height = "35">&nbsp;
                    行政管理</button>

                <div class = "profile">
                    <button class = "tablinks" data-target = "profile"><img src = "img/icon/profile.png" alt = "Profile" width = "35" height = "35">&nbsp;
                        個人</button>
                    <button class = "tablinks" data-target = "logout" onclick = "logout()" ><img src = "img/icon/logout.png" alt = "Logout" width = "35" height = "35" >&nbsp;
                        登出</button>
                </div>
            </div>
        </div>

        <?php
        //echo '<style>button.tablinks[data-target="teacher"]{display:none;}</style>';
        ?>

        <div id="home" class="tabcontent show">
            <?php echo "Welcome, " . $_SESSION['loginID']; ?>
            <p>This is the home page.</p>
        </div>





        <div id="campus" class="tabcontent">
            <table>
                <tr>
                    <td class="menu">
                        <h2 class="en" lang="en">Campus area</h2>     
                        <h2 class="zh" lang="zh">校園地帶</h2>   
                        <div class="accordion">                            
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <a href="page/campus/campus_news.php" target="ifeame_campus" class="en" lang="en" >Campus News</a>
                                    <a  href="page/campus/campus_news.php" target="ifeame_campus" class="zh" lang="zh">校園消息</a>                                 
                                </div>                               
                            </div>
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <a href="# " class="en" lang="en">Teacher Announcement</a>
                                    <a href="# " class="zh" lang="zh">班主任宣佈</a>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <a href="# " class="en" lang="en">Online Notice</a>
                                    <a href="# " class="zh" lang="zh">電子通告欄</a>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <a href="page/campus/album.php " target="ifeame_campus" class="en" lang="en">Album</a>
                                    <a href="page/campus/album.php " target="ifeame_campus" class="zh" lang="zh">校園相簿</a>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <a href="# " class="en" lang="en">Calendar</a>
                                    <a href="# " class="zh" lang="zh">行事曆</a>
                                    <span class="accordion-icon"></span>
                                </div>
                                <div class="accordion-content">
                                    <a href="page/campus/calendar/myschedule.php" target="ifeame_campus" class="en" lang="en" >My Schedule</a>
                                    <a href="page/campus/calendar/myschedule.php" target="ifeame_campus" class="zh" lang="zh">我的時間表(課堂及活動時間表)</a>
                                    <p><a href="page/campus/calendar/schoolCalendar.php" target="ifeame_campus" class="en" lang="en">School Calendar</a>
                                        <a href="page/campus/calendar/schoolCalendar.php" target="ifeame_campus" class="zh" lang="zh">校曆表</a></p>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <a href="page/campus/imail.php" target="ifeame_campus" class="en" lang="en">iMail</a>                              
                                    <a href="page/campus/imail.php" class="zh" lang="zh">電郵服務</a>                 
                                </div>                
                            </div>

                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <a href="page/campus/campus_voting.php" target="ifeame_campus" class="en" lang="en">Campus Voting</a>
                                    <a href="page/campus/campus_voting.php" target="ifeame_campus" class="zh" lang="zh">校園投票</a>                  
                                </div>                
                            </div>                            

                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <a href="page/campus/questionnaire.php" target="ifeame_campus" class="en" lang="en">Questionnaire</a>
                                    <a href="page/campus/questionnaire.php" target="ifeame_campus" class="zh" lang="zh">問卷</a>                        
                                </div>                
                            </div>

                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <a href="# " class="en" lang="en">Student Activities</a>
                                    <a href="# " class="zh" lang="zh">學生活動</a>         
                                    <span class="accordion-icon"></span>
                                </div>
                                <div class="accordion-content">                                
                                    <a href="page/campus/activityregistration.php" target="ifeame_campus" class="en" lang="en">Activity Registration</a>
                                    <a href="page/campus/activityregistration.php" class="zh" lang="zh">活動報名</a>         
                                    <p> <a href="# " class="en" lang="en">Activity Record</a>
                                        <a href="# " class="zh" lang="zh">活動紀錄</a></p>
                                </div>
                            </div>                         

                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <a href="# " class="en" lang="en">Download Document</a>
                                    <a href="# " class="zh" lang="zh">文件下載</a>         
                                    <span class="accordion-icon"></span>
                                </div>
                                <div class="accordion-content">                                   
                                    <a href="# " class="en" lang="en">School Calendar</a>
                                    <a href="# " class="zh" lang="zh">校曆表</a>                                      
                                    <p><a href="# " class="en" lang="en">Academic Performance</a>
                                        <a href="# " class="zh" lang="zh">學業成續單</a> </p>                                    
                                </div>
                            </div>

                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <a href="# " class="en" lang="en">Payment Management</a>
                                    <a href="# " class="zh" lang="zh">繳費管理</a>       
                                    <span class="accordion-icon"></span>
                                </div>
                                <div class="accordion-content">
                                    <a href="# " class="en" lang="en">Payment Record</a>
                                    <a href="# " class="zh" lang="zh">繳費紀錄</a>     
                                    <p><a href="# " class="en" lang="en">Payment</a>
                                        <a href="# " class="zh" lang="zh">繳交費用</a>     </p>             
                                </div>
                            </div>
                        </div>                       
                    </td>                    
                    <td class="iframtd">                       
                        <iframe src="" title="Campus" name = 'ifeame_campus'></iframe>
                    </td>
                </tr>
            </table>
        </div>


        <div id="school" class="tabcontent">      
            <table>
                <tr>
                    <td class="menu">
                        <h2 class="en" lang="en">School Centre</h2>     
                        <h2 class="zh" lang="zh">學校中心</h2>    
                        <div class="accordion">
                            <div class="accordion-item">
                                <div class="accordion-header" >                                
                                    <a href="# " class="en" lang="en">eLibrary Service</a>
                                    <a href="# " class="zh" lang="zh">網上圖書館服務</a>     
                                    <span class="accordion-icon"></span>
                                </div>
                                <div class="accordion-content">
                                    <a href="# " class="en" lang="en">Borrowing & Returning Records</a>
                                    <a href="# " class="zh" lang="zh">圖書借還紀錄</a>  
                                    <p><a href="page/schoolcentre/eLibrary.php" target="ifeame_center" class="en" lang="en">Book Search</a>
                                        <a href="page/schoolcentre/eLibrary.php" target="ifeame_center" class="zh" lang="zh">尋找圖書</a>  </p>
                                    <p><a href="# " class="en" lang="en">Book Reserve</a>
                                        <a href="# " class="zh" lang="zh">預約借書</a>  </p>                                   
                                </div>
                            </div>

                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <a href="# " class="en" lang="en">Useful Website</a>
                                    <a href="# " class="zh" lang="zh">常用網站</a>     
                                </div>
                            </div>

                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <a href="# " class="en" lang="en">Online Resource</a>
                                    <a href="# " class="zh" lang="zh">網上資源</a>
                                </div>                               
                            </div>                            
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <a href="# " class="en" lang="en">Homework</a>
                                    <a href="# " class="zh" lang="zh">家課冊</a>             
                                </div>
                            </div> 
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <a href="# " class="en" lang="en">e-Classroom</a>
                                    <a href="# " class="zh" lang="zh">網上教室</a>             
                                </div>
                            </div> 
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <a href="page/schoolcentre/qa_system.php" target="ifeame_center" class="en" lang="en">Interactive Q&A</a>
                                    <a href="page/schoolcentre/qa_system.php" target="ifeame_center" class="zh" lang="zh">互動問答</a>     
                                </div>
                            </div>   

                        </div>
                    </td>
                    <td class="iframtd">                       
                        <iframe src="" title="Center" name = 'ifeame_center'></iframe>
                    </td>
                </tr>
            </table>
        </div>       

        <div id="teacher" class="tabcontent">
            <table>
                <tr>
                    <td class="menu">
                        <h2 class="en" lang="en">Teacher Work Place</h2>     
                        <h2 class="zh" lang="zh">老師工作間</h2>    
                        <div class="accordion">

                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <a href="# " class="en" lang="en">Teaching Plan</a>
                                    <a href="# " class="zh" lang="zh">教學方案</a>  
                                </div>
                            </div>
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <a  href="ex_upload.php" target="ifeame_teacher" class="en" lang="en">Exercise</a>
                                    <a href="ex_upload.php" target="ifeame_teacher" class="zh" lang="zh">練習筆記</a>  
                                </div>
                            </div>
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <a href="# " class="en" lang="en">Exam paper</a>
                                    <a href="# " class="zh" lang="zh">試卷</a>  
                                </div>
                            </div> 
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <a href="# " class="en" lang="en">Facility management</a>
                                    <a href="# " class="zh" lang="zh">設施管理</a>  
                                    <span class="accordion-icon"></span>
                                </div>
                                <div class="accordion-content">
                                    <a href="page/workplace/facilityReservation.php" target="ifeame_teacher" class="en" lang="en">Facility Reservation</a>
                                    <a href="page/workplace/facilityReservation.php" target="ifeame_teacher" class="zh" lang="zh">設施預訂</a>  
                                    <p><a href="# " class="en" lang="en">Record</a>
                                        <a href="# " class="zh" lang="zh">紀錄</a>  </p>                                                               
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="iframtd">
                        <iframe src="" title="Teacher" name = 'ifeame_teacher'></iframe>
                    </td>
                </tr>
            </table>
        </div>

        <div id="admin" class="tabcontent">     
            <table>
                <tr>
                    <td class="menu">
                        <h2 class="en" lang="en">Admin Management</h2>     
                        <h2 class="zh" lang="zh">行政管理</h2>    

                        <div class="accordion">

                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <a href="# " class="en" lang="en">School Setting</a>
                                    <a href="# " class="zh" lang="zh">學校設定</a>  
                                    <span class="accordion-icon"></span>
                                </div>
                                <div class="accordion-content">
                                    <a href="page/admin/createAcc.php" target="ifeame_admin" class="en" lang="en">Add User</a>
                                    <a href="page/admin/createAcc.php" target="ifeame_admin" class="zh" lang="zh">添加用戶</a>  
                                    <p><a href="page/admin/listuser.php" target="ifeame_admin" class="en" lang="en">List User</a>
                                        <a href="page/admin/listuser.php" target="ifeame_admin" class="zh" lang="zh">列出用戶</a>  </p>                                   
                                </div>
                            </div>

                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <a href="# " class="en" lang="en">Students</a>
                                    <a href="# " class="zh" lang="zh">學生</a>  
                                    <span class="accordion-icon"></span>
                                </div>
                                <div class="accordion-content">
                                    <a href="page/admin/registerStudent.php" target="ifeame_admin" class="en" lang="en">Register</a>
                                    <a href="page/admin/registerStudent.php" target="ifeame_admin" class="zh" lang="zh">登記</a>  
                                    <p><a href="page/admin/viewenrollment.php" target="ifeame_admin" class="en" lang="en">View Enrollment</a>
                                        <a href="page/admin/viewenrollment.php " target="ifeame_admin" class="zh" lang="zh">查看註冊</a>  </p>                              
                                </div>
                            </div>

                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <a href="# " class="en" lang="en">Subjects</a>
                                    <a href="# " class="zh" lang="zh">科目</a>  
                                    <span class="accordion-icon"></span>
                                </div>
                                <div class="accordion-content">
                                    <a href="# " class="en" lang="en">Registered Subjects</a>
                                    <a href="# " class="zh" lang="zh">註冊科目</a>  
                                    <p><a href="# " class="en" lang="en">Class Teachers</a>
                                        <a href="# " class="zh" lang="zh">班主任</a>  </p>

                                </div>
                            </div>

                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <a href="# " class="en" lang="en">School Attendance Record</a>
                                    <a href="# " class="zh" lang="zh">校勤紀錄</a>                                    
                                </div>                              
                            </div>
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <a href="# " class="en" lang="en">eNotice</a>
                                    <a href="# " class="zh" lang="zh">電子通告匯入</a>                                    
                                </div>                              
                            </div>
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <a href="# " class="en" lang="en">Homework</a>
                                    <a href="# " class="zh" lang="zh">家課匯入</a>                                    
                                </div>                              
                            </div>

                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <a href="# " class="en" lang="en">General Data Storage</a>
                                    <a href="# " class="zh" lang="zh">綜合資料庫</a>  
                                    <span class="accordion-icon"></span>
                                </div>
                                <div class="accordion-content">
                                    <a href="# " class="en" lang="en">Personal Information</a>
                                    <a href="# " class="zh" lang="zh">個人詳細資料</a>  
                                    <p><a href="# " class="en" lang="en">Course Information</a>
                                        <a href="# " class="zh" lang="zh">課程/單元資料</a>  </p>
                                    <p><a href="# " class="en" lang="en">Performance Appraisal Record</a>
                                        <a href="# " class="zh" lang="zh">考績紀錄</a>  </p>
                                    <p><a href="# " class="en" lang="en">Semester Performance</a>
                                        <a href="# " class="zh" lang="zh">學期成績</a>  </p>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <a href="# " class="en" lang="en">Electronic application</a>
                                    <a href="# " class="zh" lang="zh">電子申請</a>  
                                    <span class="accordion-icon"></span>
                                </div>                               
                                <div class="accordion-content">
                                    <a href="page/admin/appholiday.php" target="ifeame_admin"class="en" lang="en">Hoilday</a>
                                    <a href="page/admin/appholiday.php" target="ifeame_admin"class="zh" lang="zh">假期</a>
                                </div>
                            </div>








                        </div>
                    </td>
                    <td class="iframtd">
                        <iframe src="" title="Admin" name = 'ifeame_admin'></iframe>
                    </td>
                </tr>
            </table>
        </div>



        <div id="profile" class="tabcontent">     
            <table>
                <tr>
                    <td class="menu">
                        <h2 class="en" lang="en">Profile</h2>     
                        <h2 class="zh" lang="zh">個人</h2>                            

                        <div class="accordion">

                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <a href="# " class="en" lang="en">eClass App</a>
                                    <a href="# " class="zh" lang="zh">eClass App</a>  
                                </div>
                            </div>

                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <a href="# " class="en" lang="en">Setting</a>
                                    <a href="# " class="zh" lang="zh">設定</a>  
                                </div>
                            </div>

                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <a href="# " class="en" lang="en">School Attendance Record</a>
                                    <a href="# " class="zh" lang="zh">校勤紀錄</a>  
                                </div>
                            </div>

                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <a href="# " class="en" lang="en">Profile</a>
                                    <a href="# " class="zh" lang="zh">個人檔案</a>  
                                    <span class="accordion-icon"></span>
                                </div>
                                <div class="accordion-content">
                                    <a href="# " class="en" lang="en">Personal Information</a>
                                    <a href="# " class="zh" lang="zh">個人詳細資料</a>  
                                    <p><a href="# " class="en" lang="en">Course Information</a>
                                        <a href="# " class="zh" lang="zh">課程/單元資料</a>  </p>
                                    <p><a href="# " class="en" lang="en">Performance Appraisal Record</a>
                                        <a href="# " class="zh" lang="zh">考績紀錄</a>  </p>  
                                    <p><a href="# " class="en" lang="en">Awarding Certificates/Achievements</a>
                                        <a href="# " class="zh" lang="zh">頒授證書/成就</a>  </p>       
                                    <p><a href="# " class="en" lang="en">Semester Performance</a>
                                        <a href="# " class="zh" lang="zh">學期成績</a>  </p>       
                                </div>
                            </div>

                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <a href="# " class="en" lang="en">Electronic application</a>
                                    <a href="# " class="zh" lang="zh">電子申請</a>  
                                    <span class="accordion-icon"></span>
                                </div>
                                <div class="accordion-content">
                                    <a href="# " class="en" lang="en">Medical Certificate</a>
                                    <a href="# " class="zh" lang="zh">醫療證明</a>  
                                    <p><a href="# " class="en" lang="en">Study Tours</a>
                                        <a href="# " class="zh" lang="zh">遊學團</a>  </p>                                      
                                </div>
                            </div>
                        </div>

                    </td>
                    <td class="iframtd">
                        <iframe src="" title="Test"></iframe>
                    </td>
                </tr>
            </table>
        </div>
        <div id="logout" class="tabcontent">
            <h3>Logout</h3>
            <p>You have successfully logged out.</p>
        </div>
        <script src="js/main.js"></script>

        <span >CopyRight @ Gp3 - 2023</span>
    </body>
</html>