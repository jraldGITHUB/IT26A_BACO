<?php
include("db.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);

$search = isset($_GET['search']) ? mysqli_real_escape_string($con, $_GET['search']) : '';

$query = "
    SELECT 
        i.instructor_id,
        i.instructor_fullname,
        i.instructor_email,
        i.instructor_DOB,
        GROUP_CONCAT(DISTINCT c.course_name ORDER BY c.course_name SEPARATOR ', ') AS courses,
        GROUP_CONCAT(DISTINCT d.department_name ORDER BY d.department_name SEPARATOR ', ') AS departments
    FROM tbl_instructor i
    LEFT JOIN tbl_teaching_assignment ta ON i.instructor_id = ta.instructor_id
    LEFT JOIN tbl_course c ON ta.course_id = c.course_id
    LEFT JOIN tbl_department d ON c.department_id = d.department_id
    WHERE i.instructor_fullname LIKE '%$search%'
    GROUP BY i.instructor_id
    ORDER BY i.instructor_fullname ASC
";

$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Instructor List</title>
  <link rel="stylesheet" href="dashboard.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
</head>
<body>
<div class="container">

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
      <a href="instructor.php" class="nav-item active"><i class="fas fa-user-tie"></i> Instructors</a>
    <a href="teachingAssignment.php" class="nav-item"><i class="fas fa-chalkboard-teacher"></i> Teaching Assignments</a>


    <div class="menu-heading">System</div>
    <a href="login.php" class="nav-item"><i class="fas fa-sign-out-alt"></i> Logout</a>
  </div>
</div>

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

<div class="main-content">
  <div class="page-title">
    <div class="title">Instructor Records</div>
  </div>

  <form method="get" class="mb-3" style="max-width: 400px;">
    <div class="input-group">
      <input type="text" name="search" class="form-control" placeholder="Search by name" value="<?php echo htmlspecialchars($search); ?>">
      <button type="submit" class="btn btn-primary">Search</button>
      <a href="instructor.php" class="btn btn-secondary">Reset</a>
    </div>
  </form>

  <div class="table-card">
    <div class="card-title">
      <h3><i class="fas fa-user-tie"></i> Instructors</h3>
    </div>
    <a href="instructor_create.php" class="btn btn-outline btn-sm"><i class="fas fa-plus"></i> Add Instructor</a>

    <table class="data-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Full Name</th>
          <th>Email</th>
          <th>Date of Birth</th>
          <th>Department(s)</th>
          <th>Courses</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
      <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
          <tr>
            <td><?php echo $row['instructor_id']; ?></td>
            <td><?php echo $row['instructor_fullname']; ?></td>
            <td><?php echo $row['instructor_email']; ?></td>
            <td><?php echo $row['instructor_DOB']; ?></td>
            <td><?php echo $row['departments'] ?? 'N/A'; ?></td>
            <td><?php echo $row['courses'] ?? 'None'; ?></td>
            <td>
              <a href="instructor_edit.php?id=<?php echo $row['instructor_id']; ?>" class="btn btn-outline btn-sm">
                <i class="fas fa-edit"></i> Edit
              </a>
              <a href="instructor_delete.php?id=<?php echo $row['instructor_id']; ?>" 
                 class="btn btn-outline btn-sm"
                 onclick="return confirm('Are you sure you want to delete this instructor?');">
                <i class="fas fa-trash"></i> Delete
              </a>
            </td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr>
          <td colspan="7" class="text-center">No instructors found.</td>
        </tr>
      <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
</div>
</body>
</html>
