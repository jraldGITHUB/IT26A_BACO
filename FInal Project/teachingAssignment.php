<?php
include("db.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);

$search = isset($_GET['search']) ? mysqli_real_escape_string($con, $_GET['search']) : '';

$query = "
    SELECT 
        ta.teach_assign_id,
        i.instructor_fullname,
        i.instructor_email,
        c.course_name,
        ta.semester,
        s.schedule_id,
        s.day,
        s.time_start,
        s.time_end,
        cl.room_number
    FROM tbl_teaching_assignment ta
    LEFT JOIN tbl_instructor i ON ta.instructor_id = i.instructor_id
    LEFT JOIN tbl_course c ON ta.course_id = c.course_id
    LEFT JOIN tbl_schedule s ON ta.teach_assign_id = s.teach_assign_id
    LEFT JOIN tbl_classroom cl ON s.classroom_id = cl.classroom_id
    WHERE i.instructor_fullname LIKE '%$search%'
        OR c.course_name LIKE '%$search%'
    ORDER BY ta.teach_assign_id DESC
";

$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Teaching Assignments</title>
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
      <a href="dad.php" class="nav-item"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
      <a href="students.php" class="nav-item"><i class="fas fa-user-graduate"></i> Students</a>
      <a href="course.php" class="nav-item"><i class="fas fa-book"></i> Courses</a>
      <a href="enrollment.php" class="nav-item"><i class="fas fa-edit"></i> Enrollments</a>
      <a href="teachingAssignment.php" class="nav-item active"><i class="fas fa-chalkboard-teacher"></i> Teaching Assignments</a>

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
      <div class="title">Teaching Assignments</div>
    </div>

    <!-- Search Form -->
    <form method="get" class="mb-3" style="max-width: 400px;">
      <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Search by instructor or course" value="<?php echo htmlspecialchars($search); ?>">
        <button type="submit" class="btn btn-primary">Search</button>
        <a href="teachingAssignment.php" class="btn btn-secondary">Reset</a>
      </div>
    </form>

    <!-- Table -->
    <div class="table-card">
      <div class="card-title">
        <h3><i class="fas fa-chalkboard-teacher"></i> Teaching Assignments with Schedule</h3>
      </div>
      <table class="data-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Instructor</th>
            <th>Email</th>
            <th>Course</th>
            <th>Semester</th>
            <th>Schedule ID</th>
            <th>Day</th>
            <th>Start</th>
            <th>End</th>
            <th>Room</th>
          </tr>
        </thead>
        <tbody>
        <?php if (mysqli_num_rows($result) > 0): ?>
          <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
              <td><?php echo $row['teach_assign_id']; ?></td>
              <td><?php echo $row['instructor_fullname']; ?></td>
              <td><?php echo $row['instructor_email']; ?></td>
              <td><?php echo $row['course_name']; ?></td>
              <td><?php echo $row['semester']; ?></td>
              <td><?php echo $row['schedule_id']; ?></td>
              <td><?php echo $row['day']; ?></td>
              <td><?php echo $row['time_start']; ?></td>
              <td><?php echo $row['time_end']; ?></td>
              <td><?php echo $row['room_number']; ?></td>
        
     
    </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr>
            <td colspan="10" class="text-center">No teaching assignments found.</td>
          </tr>
        <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

</div>
</body>
</html>
