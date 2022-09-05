import './bootstrap';

// Delete post modal
let deletePost = document.querySelectorAll('.delete-post');
let delPostBtn = document.querySelector('.del-post-btn');

deletePost.forEach((post) => {
    post.addEventListener('click', function(e) {
        delPostBtn.dataset.postId = e.target.dataset.postId;
    });
});

delPostBtn.addEventListener('click', function(e) {
    e.target.dataset.postId;
    
});