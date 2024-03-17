const express = require('express');
const app = express();

// Sample data (replace with your actual database)
const users = [
    { userID: 71, u_fname: 'Marko', u_lname: 'Petrović', email: 'marko@example.com', city: 'Subotica', photo: 'imgs/room_1.jpg', age: 25, jmbg: '0101993782921', bio: 'Marko je ljubitelj prirode i sporta.', budget: 500, pol: 'Muško' },
    { userID: 72, u_fname: 'Jovana', u_lname: 'Đorđević', email: 'jovana@example.com', city: 'Subotica', photo: 'imgs/room_2.jpg', age: 30, jmbg: '0712965446123', bio: 'Jovana je strastvena ljubiteljka knjiga i umetnost', budget: 550, pol: 'Žensko' },
    // More users...
];

// Route to filter users based on location
app.get('/filterUsers', (req, res) => {
    const location = req.query.location;

    // Perform filtering based on user location
    const filteredUsers = users.filter(user => user.city === location);

    res.json(filteredUsers);
});

// Start server
const PORT = process.env.PORT || 3000;
app.listen(PORT, () => console.log(`Server running on port ${PORT}`));


// Function to fetch and display filtered users based on location
function fetchFilteredUsers(location) {
    // Send location data to server for filtering
    fetch('/filterUsers?location=' + location)
        .then(response => response.json())
        .then(data => {
            // Clear existing user display (if any)
            document.getElementById('user-container').innerHTML = '';

            // Generate HTML for each user
            data.forEach(user => {
                // Create user HTML
                const userHTML = `
                    <div class="user">
                        <img src="${user.photo}" alt="${user.u_fname} ${user.u_lname}">
                        <h2>${user.u_fname} ${user.u_lname}</h2>
                        <p>Email: ${user.email}</p>
                        <p>Age: ${user.age}</p>
                        <p>Bio: ${user.bio}</p>
                    </div>
                `;
                // Append user HTML to container
                document.getElementById('user-container').innerHTML += userHTML;
            });
        })
        .catch(error => console.error('Error fetching filtered users:', error));
}

// Get user location (assuming you have this functionality)
const userLocation = 'Subotica'; // You can replace this with actual user location
fetchFilteredUsers(userLocation);
