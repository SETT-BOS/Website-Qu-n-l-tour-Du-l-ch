function uploadAvatar() {
    const input = document.getElementById('avatarInput');
    const file = input.files[0];
    
    if (file) {
        // Kiểm tra định dạng file
        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        if (!allowedTypes.includes(file.type)) {
            alert('Vui lòng chọn file ảnh (JPG, PNG, GIF)');
            return;
        }
        
        // Kiểm tra kích thước file (max 5MB)
        if (file.size > 5 * 1024 * 1024) {
            alert('Kích thước file không được vượt quá 5MB');
            return;
        }
        
        // Hiển thị preview
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('avatarPreview').src = e.target.result;
            
            // Lưu vào session storage theo user ID
            const userId = '<?= getCurrentUser()->id ?? "guest" ?>';
            sessionStorage.setItem('userAvatar_' + userId, e.target.result);
            
            // Cập nhật ảnh trong header ngay lập tức
            if (typeof updateHeaderAvatar === 'function') {
                updateHeaderAvatar(e.target.result);
            }
            
            // Gửi AJAX request để lưu ảnh
            uploadAvatarToServer(e.target.result);
        };
        reader.readAsDataURL(file);
    }
}

function uploadAvatarToServer(imageData) {
    fetch(BASE_URL + 'upload-avatar', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            avatar: imageData
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('Avatar uploaded successfully');
        } else {
            console.error('Upload failed:', data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

// Khôi phục ảnh từ session storage khi load trang
document.addEventListener('DOMContentLoaded', function() {
    const userId = '<?= getCurrentUser()->id ?? "guest" ?>';
    const savedAvatar = sessionStorage.getItem('userAvatar_' + userId);
    if (savedAvatar) {
        document.getElementById('avatarPreview').src = savedAvatar;
    }
});