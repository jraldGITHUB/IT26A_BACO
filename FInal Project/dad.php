<?php
require_once('db.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Real-time counts
$student_count = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS total FROM tbl_student"))['total'];
$course_count = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS total FROM tbl_course"))['total'];
$enrollment_count = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS total FROM tbl_enrollment"))['total'];

// Recent enrollments JOIN
$query = "
SELECT 
    e.enrollment_id,
    CONCAT(s.student_first_name, ' ', s.student_last_name) AS student_name,
    c.course_name,
    e.grade
FROM tbl_enrollment e
JOIN tbl_student s ON e.student_id = s.student_id
JOIN tbl_course c ON e.course_id = c.course_id
ORDER BY e.enrollment_id DESC
LIMIT 5
";

$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Enrollment Dashboard</title>
  <link rel="stylesheet" href="dashboard.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
</head>
<body>
  <div class="container">
    <!-- Sidebar -->
<div class="sidebar">
  <div class="logo">
    <h1>Enrollment<span>System</span></h1>
  </div>
  <div class="nav-menu">
    <div class="menu-heading">Main</div>
    <a href="dad.php" class="nav-item active"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
    <a href="students.php" class="nav-item "><i class="fas fa-user-graduate"></i> Students</a>
    <a href="course.php" class="nav-item"><i class="fas fa-book"></i> Courses</a>
    <a href="enrollment.php" class="nav-item"><i class="fas fa-edit"></i> Enrollments</a>
     <a href="instructor.php" class="nav-item "><i class="fas fa-user-tie"></i> Instructors</a>
    <a href="teachingAssignment.php" class="nav-item "><i class="fas fa-chalkboard-teacher"></i> Teaching Assignments</a>

    <div class="menu-heading">System</div>
   
    <a href="login.php" class="nav-item"><i class="fas fa-sign-out-alt"></i> Logout</a>
  </div>
</div>

  

    <!-- Header -->
    <div class="header">
      <div class="header-actions">
        <div class="user-profile">
          <div class="profile-img">AD</div>
          <div class="user-info">
            <div class="user-name">Admin</div>
            <div class="user-role">Enrollment Manager</div>
          </div>
        </div>
      </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
      <div class="page-title">
        <div class="title">Dashboard</div>
        <div class="action-buttons">
            <a href="enrollment.php" class="btn btn-outline btn-sm"><i class="fas fa-eye"></i> New Enrollments</a>  
    
          
          </button>
        </div>
      </div>

      <!-- Stats Cards -->
      <div class="stats-cards">
        <div class="stat-card">
          <div class="card-header">
            <div>
              <div class="card-value"><?php echo $student_count; ?></div>
              <div class="card-label">Total Students</div>
            </div>
            <div class="card-icon purple"><i class="fas fa-user-graduate"></i></div>
          </div>
        </div>

        <div class="stat-card">
          <div class="card-header">
            <div>
              <div class="card-value"><?php echo $course_count; ?></div>
              <div class="card-label">Courses Offered</div>
            </div>
            <div class="card-icon blue"><i class="fas fa-book"></i></div>
          </div>
        </div>

        <div class="stat-card">
          <div class="card-header">
            <div>
              <div class="card-value"><?php echo $enrollment_count; ?></div>
              <div class="card-label">Total Enrollments</div>
            </div>
            <div class="card-icon green"><i class="fas fa-edit"></i></div>
          </div>
        </div>
      </div>

      <!-- Recent Enrollments -->
      <div class="table-card">
        <div class="card-title">
          <h3><i class="fas fa-list"></i> Recent Enrollments</h3>
          <a href="enrollment.php" class="btn btn-outline btn-sm"><i class="fas fa-eye"></i> View All</a>
        </div>
        <table class="data-table">
          <thead>
            <tr>
              <th>Enrollment ID</th>
              <th>Student</th>
              <th>Course</th>
              <th>Grade</th>
            </tr>
          </thead>
          <tbody>
          <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
              <td><?php echo $row['enrollment_id']; ?></td>
              <td><?php echo $row['student_name']; ?></td>
              <td><?php echo $row['course_name']; ?></td>
              <td><?php echo $row['grade']; ?></td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>
