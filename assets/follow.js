const followButton = document.querySelector('.followButton');

followButton.addEventListener('click', (event) => {
  event.preventDefault();

  const followLink = event.currentTarget;
  const link = followLink.href;

  fetch(link)
    .then((res) => res.json())
    .then((follow) => {
      const userLikeIcon = userLikeLink.firstElementChild;

      if (userLike.heart === true) {
        userLikeIcon.classList.add('fas');
        userLikeIcon.classList.add('text-danger');
        userLikeIcon.classList.remove('far');
        userLikeIcon.classList.remove('text-white');
      } else {
        userLikeIcon.classList.add('far');
        userLikeIcon.classList.add('text-white');
        userLikeIcon.classList.remove('fas');
        userLikeIcon.classList.remove('text-danger');
      }

      if (userLike.match === true) {
        const matchModal = new bootstrap.Modal(
          document.getElementById('matchModal')
        );
        matchModal.show();
      }
    });
});
