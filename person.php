<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobConnect - Profile Page</title>
    <link rel="stylesheet" href="personCSS.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <div class="container">
        <div class="profile-header">
            <div class="cover-photo"></div>
            <div class="profile-info">
                <div class="profile-picture">
                    <img src="<?php echo $user['profile_picture'] ?? 'images/default-avatar.png'; ?>" alt="Profile picture">
                    <div class="change-photo" onclick="document.getElementById('uploadPhotoModal').classList.add('show-modal')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
                    </div>
                </div>
                <div class="user-details">
                    <h1 class="user-name"><?php echo $user['full_name']; ?></h1>
                    <p class="headline"><?php echo $user['headline']; ?></p>
                    <p class="location">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 5px;"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        <?php echo $user['location']; ?>
                    </p>
                </div>
                <button class="edit-profile-btn" onclick="toggleEditMode()">Edit Profile</button>
            </div>
        </div>

        <div class="profile-content">
            <div class="profile-sidebar">
                <div class="card">
                    <div class="card-title">
                        About
                        <span class="edit-icon" onclick="toggleEditMode('about-section')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        </span>
                    </div>
                    <div id="about-view">
                        <p><?php echo $user['about']; ?></p>
                    </div>
                    <div id="about-edit" style="display: none;">
                        <div class="form-group">
                            <textarea name="about" rows="4"><?php echo $user['about']; ?></textarea>
                        </div>
                        <button class="save-btn" onclick="saveSection('about')">Save</button>
                        <button class="cancel-btn" onclick="toggleEditMode('about-section')">Cancel</button>
                    </div>
                </div>

                <div class="card">
                    <div class="card-title">
                        Contact Information
                        <span class="edit-icon" onclick="toggleEditMode('contact-section')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        </span>
                    </div>
                    <div id="contact-view">
                        <p>Email: <?php echo $user['email']; ?></p>
                        <p>Phone: <?php echo $user['phone']; ?></p>
                        <p>Website: <?php echo $user['website']; ?></p>
                    </div>
                    <div id="contact-edit" style="display: none;">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" value="<?php echo $user['email']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="tel" name="phone" value="<?php echo $user['phone']; ?>">
                        </div>
                        <div class="form-group">
                            <label>Website</label>
                            <input type="text" name="website" value="<?php echo $user['website']; ?>">
                        </div>
                        <button class="save-btn" onclick="saveSection('contact')">Save</button>
                        <button class="cancel-btn" onclick="toggleEditMode('contact-section')">Cancel</button>
                    </div>
                </div>

                <div class="card">
                    <div class="card-title">
                        Account Settings
                    </div>
                    <div>
                        <div class="form-group">
                            <button class="save-btn" onclick="document.getElementById('changePasswordModal').classList.add('show-modal')" style="width: 100%;">Change Password</button>
                        </div>
                        <p class="delete-account" onclick="document.getElementById('deleteAccountModal').classList.add('show-modal')">Delete Account</p>
                    </div>
                </div>
            </div>

            <div class="profile-main">
                <div class="card">
                    <div class="card-title">
                        Experience
                        <span class="edit-icon" onclick="toggleEditMode('experience-section')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        </span>
                    </div>
                    <div id="experience-view">
                        <?php foreach ($experiences as $experience): ?>
                        <div style="margin-bottom: 15px;">
                            <h3><?php echo $experience['title']; ?></h3>
                            <p><?php echo $experience['company']; ?> • <?php echo $experience['employment_type']; ?></p>
                            <p style="color: var(--text-light);"><?php echo $experience['duration']; ?></p>
                            <p><?php echo $experience['description']; ?></p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div id="experience-edit" style="display: none;">
                        <!-- Experience editing form would go here -->
                        <button class="save-btn" onclick="saveSection('experience')">Save</button>
                        <button class="cancel-btn" onclick="toggleEditMode('experience-section')">Cancel</button>
                    </div>
                </div>

                <div class="card">
                    <div class="card-title">
                        Education
                        <span class="edit-icon" onclick="toggleEditMode('education-section')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        </span>
                    </div>
                    <div id="education-view">
                        <?php foreach ($education as $edu): ?>
                        <div>
                            <h3><?php echo $edu['institution']; ?></h3>
                            <p><?php echo $edu['degree']; ?></p>
                            <p style="color: var(--text-light);"><?php echo $edu['years']; ?></p>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div id="education-edit" style="display: none;">
                        <!-- Education editing form would go here -->
                        <button class="save-btn" onclick="saveSection('education')">Save</button>
                        <button class="cancel-btn" onclick="toggleEditMode('education-section')">Cancel</button>
                    </div>
                </div>

                <div class="card">
                    <div class="card-title">
                        Skills
                        <span class="edit-icon" onclick="toggleEditMode('skills-section')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        </span>
                    </div>
                    <div id="skills-view">
                        <p><?php echo $user['skills']; ?></p>
                    </div>
                    <div id="skills-edit" style="display: none;">
                        <div class="form-group">
                            <input type="text" name="skills" value="<?php echo $user['skills']; ?>">
                        </div>
                        <button class="save-btn" onclick="saveSection('skills')">Save</button>
                        <button class="cancel-btn" onclick="toggleEditMode('skills-section')">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Upload Photo Modal -->
    <div id="uploadPhotoModal" class="modal">
        <div class="modal-content">
            <div class="modal-title">Upload Profile Picture</div>
            <form action="profile_actions.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="action" value="upload_photo">
                <div class="form-group">
                    <label>Choose a new profile picture:</label>
                    <input type="file" name="profile_picture" accept="image/*">
                </div>
                <div class="modal-actions">
                    <button type="button" class="cancel-btn" onclick="document.getElementById('uploadPhotoModal').classList.remove('show-modal')">Cancel</button>
                    <button type="submit" class="save-btn">Upload</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Change Password Modal -->
    <div id="changePasswordModal" class="modal">
        <div class="modal-content">
            <div class="modal-title">Change Password</div>
            <form action="profile_actions.php" method="post">
                <input type="hidden" name="action" value="change_password">
                <div class="form-group">
                    <label>Current Password</label>
                    <input type="password" name="current_password" required>
                </div>
                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" name="new_password" required>
                </div>
                <div class="form-group">
                    <label>Confirm New Password</label>
                    <input type="password" name="confirm_password" required>
                </div>
                <div class="modal-actions">
                    <button type="button" class="cancel-btn" onclick="document.getElementById('changePasswordModal').classList.remove('show-modal')">Cancel</button>
                    <button type="submit" class="save-btn">Update Password</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Account Modal -->
    <div id="deleteAccountModal" class="modal">
        <div class="modal-content">
            <div class="modal-title">Delete Account</div>
            <p>Are you sure you want to delete your account? This action cannot be undone.</p>
            <form action="profile_actions.php" method="post">
                <input type="hidden" name="action" value="delete_account">
                <div class="form-group">
                    <label>Please enter your password to confirm:</label>
                    <input type="password" name="password" required>
                </div>
                <div class="modal-actions">
                    <button type="button" class="cancel-btn" onclick="document.getElementById('deleteAccountModal').classList.remove('show-modal')">Cancel</button>
                    <button type="submit" class="save-btn" style="background-color: var(--danger);">Delete Account</button>
                </div>
            </form>
        </div>
    </div>

    <script src="js/personJS.js"></script>
</body>
</html>