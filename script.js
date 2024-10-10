
// Function to handle pip form submission
document.querySelector('form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const content = document.querySelector('textarea[name="content"]').value; 

    fetch('home.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `content=${encodeURIComponent(content)}`
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);
        document.querySelector('textarea[name="content"]').value = '';
    })
    .catch(error => console.error('Error:', error));
});

// Show the overlay when the "Create Pip" button is clicked
document.getElementById('pip-button').addEventListener('click', function() {
    document.getElementById('pip-overlay').style.display = 'block'; // Show the overlay
});

// Close the overlay when the close button is clicked
document.getElementById('close-overlay').addEventListener('click', function() {
    document.getElementById('pip-overlay').style.display = 'none'; // Hide the overlay
});

// Close the overlay when clicking outside of the overlay content
window.addEventListener('click', function(event) {
    const overlay = document.getElementById('pip-overlay');
    if (event.target == overlay) {
        overlay.style.display = 'none'; // Hide the overlay
    }
});
// Character counter functionality
const textarea = document.getElementById('pip-content');
const charCountDisplay = document.getElementById('char-count');

// Update character count on input
textarea.addEventListener('input', function() {
    const currentLength = textarea.value.length;
    charCountDisplay.textContent = `${currentLength}/255 characters`;
});
// Function to handle pip form submission
document.querySelector('form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const content = document.querySelector('textarea[name="content"]').value; 

    fetch('home.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `content=${encodeURIComponent(content)}`
    })
    .then(response => response.text())
    .then(data => {
       
        console.log(data);
        document.querySelector('textarea[name="content"]').value = '';
        document.getElementById('char-count').textContent = '0/255 characters'; // Reset character count
    })
    .catch(error => console.error('Error:', error));
});

