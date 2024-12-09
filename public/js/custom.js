$(document).ready(function() {
    $('.toggle-subitems').click(function(event) {
        event.preventDefault(); // Prevent the default anchor behavior
        $(this).next('.sub-items').slideToggle(); // Toggle the next sub-items
        $(this).toggleClass('active'); // Toggle active class for rotation
    });

    $('#role-table').DataTable()

    $('#user-table').DataTable()

    $('#permission-table').DataTable()
});

$("#role-permissions").each(function(index, element) {
    $(this).select2({
        tags: true,
        width: "100%"
    });
});


/** profile Image */
const profileImageInput = document.getElementById('profile-image');
const profileImageCard = document.getElementById('profile-image-card');
const profileImagePreview = document.getElementById('profile-image-preview');

if(profileImageInput) {

    profileImageInput.addEventListener('change', function(event) {

        let profileImageFile = event.target.files[0];
        
        if (profileImageFile && (profileImageFile.type === 'image/png' || profileImageFile.type === 'image/jpeg' || profileImageFile.type === 'image/jpg')) {
        
            let profileImageReader = new FileReader();
            
            profileImageReader.onload = function(e) {
            
                profileImagePreview.src = e.target.result;
            
                profileImageCard.style.display = 'block';
            };
            
            profileImageReader.readAsDataURL(profileImageFile);
        } else {
            
            profileImageCard.style.display = 'none';
        }
    });
}

/** profile Image */


/** profile Image Update */

const profileImageUpdateInput = document.getElementById('profile-image-update');
const profileImageUpdateCard = document.getElementById('profile-image-update-card');
const profileImageUpdatePreview = document.getElementById('profile-image-update-preview');

if(profileImageUpdateInput) {

    profileImageUpdateInput.addEventListener('change', function(event) {

        let profileImageFile = event.target.files[0];
        
        if (profileImageFile && (profileImageFile.type === 'image/png' || profileImageFile.type === 'image/jpeg' || profileImageFile.type === 'image/jpg')) {
        
            let profileImageReader = new FileReader();
            
            profileImageReader.onload = function(e) {
            
                profileImageUpdatePreview.src = e.target.result;
            
                profileImageUpdateCard.style.display = 'block';
            };
            
            profileImageReader.readAsDataURL(profileImageFile);
        } else {
            
            profileImageUpdateCard.style.display = 'none';
        }
    });
}