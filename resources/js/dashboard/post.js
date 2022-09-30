import '../bootstrap';
import * as bootstrap from 'bootstrap';
import * as util from '../util.js';

// Delete post modal
let deletePost = document.querySelectorAll('.delete-post');
let delPostBtn = document.querySelector('.del-post-btn');
let spinner = document.querySelector('#delete-post-confirm-dialog .spinner-container');

deletePost.forEach((post) => { // delete post
    post.addEventListener('click', function(e) {
        util.hideElem(spinner);
        util.showElem(delPostBtn);
        delPostBtn.dataset.postId = e.target.dataset.postId;
    });
});

delPostBtn.addEventListener('click', function(e) { // confirm delete post
    let postId = e.target.dataset.postId;
    let csrfToken = e.target.parentNode.children._token.value;

    let spinner = this.parentNode.children[3];
    util.showElem(spinner);
    util.hideElem(this);

    fetch('/dashboard/post/'+ postId +'/delete', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken
        }
    })
        .then(response => response.json())
        .then(result => {
            var deletePostConfirmModalElem = document.getElementById('delete-post-confirm-dialog');
            var deletePostConfirmModal = bootstrap.Modal.getInstance(deletePostConfirmModalElem);
            var deletePostSuccessModal = new bootstrap.Modal(document.getElementById('delete-post-success-dialog'));
            var deletePostErrorModal = new bootstrap.Modal(document.getElementById('delete-post-error-dialog'));
            var deletePostErrorModalElem = document.getElementById('delete-post-error-dialog');
            var errorMessages = '';

            deletePostConfirmModal.hide();

            if(result.status === 'success') {
                deletePostSuccessModal.show();
            } else {
                for(let x in result.message) {
                    errorMessages += '<p>' + result.message[x] + '</p>';
                }
                deletePostErrorModalElem.querySelector('.error-msg').innerHTML = errorMessages;
                deletePostErrorModal.show();
            }

        });
});