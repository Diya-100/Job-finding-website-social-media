/**
 * JavaScript functions for the profile page
 */

/**
 * Toggle between view and edit modes for profile sections
 * @param {string} section - The section ID to toggle
 */
function toggleEditMode(section) {
    if (section) {
        const viewElement = document.getElementById(`${section}-view`);
        const editElement = document.getElementById(`${section}-edit`);
        
        if (viewElement.style.display !== 'none') {
            viewElement.style.display = 'none';
            editElement.style.display = 'block';
        } else {
            viewElement.style.display = 'block';
            editElement.style.display = 'none';
        }
    } else {
        // Toggle all sections (for the main Edit Profile button)
        const sections = ['about', 'contact', 'experience', 'education', 'skills'];
        
        sections.forEach(section => {
            const viewElement = document.getElementById(`${section}-view`);
            const editElement = document.getElementById(`${section}-edit`);
            
            viewElement.style.display = 'none';
            editElement.style.display = 'block';
        });
    }
}

/**
 * Save section data via AJAX
 * @param {string} section - The section being saved
 */
function saveSection(section) {
    // Get all form fields in the section
    const sectionElement = document.getElementById(`${section}-edit`);
    const formData = new FormData();
    
    // Add the action and section to the form data
    formData.append('action', 'update_profile');
    formData.append('section', section);
    
    // Add all input fields from the section
    const inputs = sectionElement.querySelectorAll('input, textarea');
    inputs.forEach(input => {
        formData.append(input.name, input.value);
    });
    
    // Send AJAX request
    fetch('profile_actions.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update the view section with new data
            updateViewSection(section, data.updatedData);
            // Toggle back to view mode
            toggleEditMode(section);
            // Show success message
            showNotification('Profile updated successfully!', 'success');
        } else {
            showNotification('Error updating profile: ' + data.message, 'error');
        }
    })
    .catch(error => {
        showNotification('Error updating profile. Please try again.', 'error');
        console.error('Error:', error);
    });
}

/**
 * Update the view section with new data
 * @param {string} section - The section to update
 * @param {object} data - The updated data
 */
function updateViewSection(section, data) {
    const viewElement = document.getElementById(`${section}-view`);
    
    // Update content based on the section
    switch(section) {
        case 'about':
            viewElement.innerHTML = `<p>${data.about}</p>`;
            break;
        case 'contact':
            viewElement.innerHTML = `
                <p>Email: ${data.email}</p>
                <p>Phone: ${data.phone}</p>
                <p>Website: ${data.website}</p>
            `;
            break;
        case 'skills':
            viewElement.innerHTML = `<p>${data.skills}</p>`;
            break;
        // For more complex sections like experience and education
        // You would need to rebuild the entire HTML based on the returned data
    }
}

/**
 * Show notification message
 * @param {string} message - The message to display
 * @param {string} type - The type of notification (success/error)
 */
function showNotification(message, type) {
    // Check if notification container exists, if not create it
    let container = document.getElementById('notification-container');
    if (!container) {
        container = document.createElement('div');
        container.id = 'notification-container';
        container.style.position = 'fixed';
        container.style.top = '20px';
        container.style.right = '20px';
        container.style.zIndex = '1000';
        document.body.appendChild(container);
    }
    
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.style.backgroundColor = type === 'success' ? '#4CAF50' : '#F44336';
    notification.style.color = 'white';
    notification.style.padding = '15px';
    notification.style.marginBottom = '10px';
    notification.style.borderRadius = '4px';
    notification.style.boxShadow = '0 2px 4px rgba(0,0,0,0.2)';
    notification.textContent = message;
    
    // Add to container
    container.appendChild(notification);
    
    // Remove after 3 seconds
    setTimeout(() => {
        notification.style.opacity = '0';
        notification.style.transition = 'opacity 0.5s';
        setTimeout(() => {
            container.removeChild(notification);
        }, 500);
    }, 3000);
}

// Add event listeners when the DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    // Close modals when clicking outside
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        modal.addEventListener('click', function(event) {
            if (event.target === modal) {
                modal.classList.remove('show-modal');
            }
        });
    });
});