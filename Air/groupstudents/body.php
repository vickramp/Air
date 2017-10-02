<?php
if(isset($_GET['dept'])&&($_GET['dept']<0||$_GET['dept']>9)){
  echo'<script type="text/javascript">
  window.location.href = \'/Air/groupstudents/\';
  </script> ';
}
if(isset($_GET['year'])&&($_GET['year']<0||$_GET['year']>6)){
  echo'<script type="text/javascript">
  window.location.href = \'/Air/groupstudents/\';
  </script> ';
}
if(isset($_GET['sem'])&&($_GET['sem']<0||$_GET['sem']>2)){
  echo'<script type="text/javascript">
  window.location.href = \'/Air/groupstudents/\';
  </script> ';
}
if(isset($_GET['div'])&&($_GET['div']!=0&&$_GET['div']!='A'&&$_GET['div']!='B'&&$_GET['div']!='C')){
  echo'<script type="text/javascript">
  window.location.href = \'/Air/groupstudents/\';
  </script> ';
}

 ?>

<!--breadcrumbs start-->
     <div id="breadcrumbs-wrapper" class=" grey lighten-3">
             <div class="container">
         <div class="row">
           <div class="col s12 m12 l12">
             <ol class="breadcrumb">

                <?php
                if(isset($_GET['dept'])&&check(4))
                  echo'<li class="active"><a href="/Air/groupstudents/">Home</a></li >';
                else if(check(4))
                  echo'<li class="active">Home</li>';
                  if(isset($_GET['dept'])){
                    switch ($_GET['dept']) {
                      case 1:$name='Civil';break;
                      case 2:$name='Chem';break;
                      case 3:$name='Cse';break;
                      case 4:$name='Ece';break;
                      case 5:$name='Eee';break;
                      case 6:$name='It';break;
                      case 7:$name='Mech';break;
                      default:$name='Unassigned';
                  }
                if(isset($_GET['year']))
                  echo'<li class="active"><a href="/Air/groupstudents/?dept='.$_GET['dept'].'">'.$name.'</a></li >';
                else
                  echo'<li class="active">'.$name.'</li>';

}
              if(isset($_GET['year'])){
                  switch ($_GET['year']) {
                    case 1:$name='I/IV Btech';break;
                    case 2:$name='II/IV Btech';break;
                    case 3:$name='III/IV Btech';break;
                    case 4:$name='IV/IV Btech';break;
                    case 5:$name='I/II Mtech';break;
                    case 6:$name='II/II Mtech';break;
                    default:$name='Unassigned';break;
                  }
                  if(isset($_GET['sem']))
                    echo'<li class="active"><a href="/Air/groupstudents/?dept='.$_GET['dept'].'&amp;year='.$_GET['year'].'">'.$name.'</a></li >';
                  else
                    echo'<li class="active">'.$name.'</li>';
}
if(isset($_GET['sem'])){
  if(isset($_GET['div']))
    echo'<li class="active"><a href="/Air/groupstudents/?dept='.$_GET['dept'].'&amp;year='.$_GET['year'].'&amp;sem='.$_GET['sem'].'">Semester '.$_GET['sem'].'</a></li >';
  else
    echo'<li class="active">Semester '.$_GET['sem'].'</li>';
}


if(isset($_GET['div'])){
  if($_GET['div']=='A'||$_GET['div']=='B'||$_GET['div']=='C')
      echo'<li class="active">'.$_GET['div'].'</li>';
else
      echo'<li class="active">Unassigned</li>';

}
?>

             </ol>
           </div>
         </div>
       </div>
     </div>
     <!--breadcrumbs end-->
     <?php
     if(check(3)&&!check(4)){
       $db=connectDataBase('users');
       $res=$db->query('select branch from user where userno='.$_SESSION['userid']);
       $db->close();
       $ans=$res->fetch_assoc();
       if(!isset($_GET['dept'])||$ans['branch']!=$_GET['dept'])
       echo'<script type="text/javascript">
       window.location.href = \'/Air/groupstudents/?dept='.$ans['branch'].'\';
       </script> ';
         }
if(!isset($_GET['dept']))
  echo'<div class="hide-on-med-and-up"><br/><br/><br/></div>
<div class="row">
            <div class="col s12 m12 l12">
              <div class="card-panel">
                <h4 class="header2 center ">Department List</h4>
                <div class="row">
              <p>    <a  href="?dept=1" class="col offset-m1 m3 offset-s1 s5 btn btn-large waves-effect waves-light red darken-4">Civil</a></p>
                <p>  <a  href="?dept=2" class="col offset-m1 m3 offset-s1  s5 btn btn-large waves-effect waves-light light-green darken-4">Chem</a></p>
                <div class="hide-on-med-and-up"><br/><br/><br/></div>
        <p>  <a  href="?dept=3" class=" col offset-m1 m3 offset-s1  s5 btn btn-large waves-effect waves-light lime darken-4">Cse</a></p>
        <div class="hide-on-small-only"><br/><br/><br/></div>        <p>  <a  href="?dept=4" class=" col offset-m1 m3 offset-s1  s5 btn btn-large waves-effect waves-light yellow darken-4">Ece</a></p>
        <div class="hide-on-med-and-up"><br/><br/><br/></div>
      <p>  <a  href="?dept=5" class=" col offset-m1 m3 offset-s1  s5 btn btn-large waves-effect waves-light purple darken-4">Eee</a></p>
                <p>  <a  href="?dept=6" class="col offset-m1 m3  offset-s1 s5 btn btn-large waves-effect waves-light pink darken-1">It</a></p>
            <div class=""><br/><br/><br/></div>       <p>  <a  href="?dept=7" class="col offset-m1 m3  offset-s1 s5 btn btn-large waves-effect waves-light grey darken-2">Mba</a></p>
                <p>  <a  href="?dept=8" class=" col offset-m1 m3 offset-s1  s5 btn btn-large waves-effect waves-light orange darken-4">Mca</a></p>
              <div class="hide-on-med-and-up"><br/><br/><br/> </div> <p>  <a  href="?dept=9" class="col offset-m1 m3  offset-s1 s5 btn btn-large waves-effect waves-light green darken-2">Mech</a></p>
              <div class="hide-on-small-only"><br/><br/><br/> </div> <p>  <a  href="?dept=0" class="col offset-m1 m3  offset-s1 s5 btn btn-large waves-effect waves-light teal darken-2">Un assigned</a></p>

                  </div>
            </div>
          </div>
      </div>';
      if(isset($_GET['dept'])&&!isset($_GET['year'])&&$_GET['dept']!=0)
        echo'<div class="hide-on-med-and-up"><br/><br/><br/></div>
      <div class="row">
                  <div class="col s12 m12 l12">
                    <div class="card-panel">
                      <h4 class="header2 center ">Year</h4>
                      <div class="row">
                    <p>    <a  href="?dept='.$_GET['dept'].'&amp;year=1" class="col offset-m1 m3 offset-s1 s5 btn btn-large waves-effect waves-light red darken-4">I/IV Btech</a></p>
                      <p>  <a  href="?dept='.$_GET['dept'].'&amp;year=2"  class="col offset-m1 m3 offset-s1  s5 btn btn-large waves-effect waves-light light-green darken-4">II/IV Btech</a></p>
                      <div class="hide-on-med-and-up"><br/><br/><br/></div>
              <p>  <a  href="?dept='.$_GET['dept'].'&amp;year=3"  class=" col offset-m1 m3 offset-s1  s5 btn btn-large waves-effect waves-light lime darken-4">III/IV Btech</a></p>
              <div class="hide-on-small-only"><br/><br/><br/></div>
              <p>  <a  href="?dept='.$_GET['dept'].'&amp;year=4"  class=" col offset-m1 m3 offset-s1  s5 btn btn-large waves-effect waves-light yellow darken-4">IV/IV Btech</a></p>
              <div class="hide-on-med-and-up"><br/><br/><br/></div>
              <p>  <a  href="?dept='.$_GET['dept'].'&amp;year=5"  class=" col offset-m1 m3 offset-s1  s5 btn btn-large waves-effect waves-light lime darken-4">I/II Mtech</a></p>
              <p>  <a  href="?dept='.$_GET['dept'].'&amp;year=6"  class=" col offset-m1 m3 offset-s1  s5 btn btn-large waves-effect waves-light yellow darken-4">II/II Mtech</a></p>
              <div ><br/><br/><br/></div>

            <p>  <a  href="?dept='.$_GET['dept'].'&amp;year=0" class=" col offset-m1 m3 offset-s1  s5 btn btn-large waves-effect waves-light purple darken-4">Unassigned</a></p>
            </div>
                  </div>
                </div>
            </div>';
            if(isset($_GET['year'])&&!isset($_GET['sem'])&&$_GET['year']!=0)
              echo'<div class="hide-on-med-and-up"><br/><br/><br/></div>
            <div class="row">
                        <div class="col s12 m12 l12">
                          <div class="card-panel">
                            <h4 class="header2 center ">Semester</h4>
                            <div class="row">
                          <p>    <a  href="?dept='.$_GET['dept'].'&amp;year='.$_GET['year'].'&amp;sem=1" class="col offset-m1 m5 offset-s1 s5 btn btn-large waves-effect waves-light red darken-4">1st Sem</a></p>
                            <p>  <a  href="?dept='.$_GET['dept'].'&amp;year='.$_GET['year'].'&amp;sem=2"  class="col offset-m1 m5 offset-s1  s5 btn btn-large waves-effect waves-light light-green darken-4">2nd Sem </a></p>
</div>
</div></div></div>
                  ';
                  if(isset($_GET['sem'])&&!isset($_GET['div'])&&$_GET['sem']!=0)
                    echo'<div class="hide-on-med-and-up"><br/><br/><br/></div>
                  <div class="row">
                              <div class="col s12 m12 l12">
                                <div class="card-panel">
                                  <h4 class="header2 center ">Section</h4>
                                  <div class="row">
                                <p>    <a  href="?dept='.$_GET['dept'].'&amp;year='.$_GET['year'].'&amp;sem='.$_GET['sem'].'&amp;div=A" class="col offset-m1 m3 offset-s1 s5 btn btn-large waves-effect waves-light red darken-4">A - Section</a></p>
                                  <p>  <a  href="?dept='.$_GET['dept'].'&amp;year='.$_GET['year'].'&amp;sem='.$_GET['sem'].'&amp;div=B"  class="col offset-m1 m3 offset-s1  s5 btn btn-large waves-effect waves-light light-green darken-4">B - Section</a></p>
                                  <div class="hide-on-med-and-up"><br/><br/><br/></div>
                          <p>  <a  href="?dept='.$_GET['dept'].'&amp;year='.$_GET['year'].'&amp;sem='.$_GET['sem'].'&amp;div=C"  class=" col offset-m1 m3 offset-s1  s5 btn btn-large waves-effect waves-light lime darken-4">C - Section</a></p>
                          <div class="hide-on-small-only"><br/><br/><br/></div>
                        <p>  <a  href="?dept='.$_GET['dept'].'&amp;year='.$_GET['year'].'&amp;sem='.$_GET['sem'].'&amp;div=0" class=" col offset-m1 m3 offset-s1  s5 btn btn-large waves-effect waves-light yellow darken-4">Unassigned</a></p>
                        </div>
                              </div>
                            </div>
                        </div>';
?>
