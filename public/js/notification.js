console.clear();

const wrapper = document.querySelector('.wrapper');

const closeAlertItem = () => {
    const alertClose = document.querySelectorAll('.alert__close');
    alertClose.forEach(item => {
        item.addEventListener('click', function () {
            item.parentNode.style.transform = 'translateX(3rem)';
            item.parentNode.style.opacity = '0';
            setTimeout(() => {
                item.parentNode.remove();
                emptyState();
            }, 100);
        });
    });
};

const emptyState = () => {
    if (wrapper.children.length > 0) {
        if (document.querySelector('.empty-state')) {
            document.querySelector('.empty-state').remove();
        }
    } else {
        const emptyItem = document.createElement('div');
        emptyItem.classList = 'empty-state';
        emptyItem.style.textAlign = 'center';
        emptyItem.style.fontSize = '2rem';
        emptyItem.innerHTML = '';
        wrapper.appendChild(emptyItem);
    }
};

const createAlert = (type,notification) => {

    if(document.querySelectorAll('.alert ').length > 5){
        document.querySelector('.wrapper ').firstElementChild.remove();
    }

    const newAlert = document.createElement('div');
    newAlert.classList = `alert alert--${type}`;
    if (type == 'success') {
        newAlert.innerHTML = `
			<svg class="alert__icon" width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
				<circle class="alert__icon-path" cx="32" cy="32" r="30.5" stroke="currentColor"></circle>
				<path class="alert__icon-path alert__icon-path--type" d="M15 33.5L25 43.5L48.5 20" stroke="currentColor"></path>
			</svg>
			<div class="alert__message">${notification}</div>
		<div class="alert__close">&times;</div>`;
    } else if (type == 'danger') {
        newAlert.innerHTML = `
			<svg class="alert__icon" width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
				<circle class="aalert__icon-path" cx="32" cy="32" r="30.5" stroke="currentColor" stroke-width="5"></circle>
				<path class="alert__icon-path alert__icon-path--type" d="M20 44L44 20" stroke="currentColor"></path>
				<path class="alert__icon-path alert__icon-path--type" d="M44 44L20 20" stroke="currentColor"></path>
			</svg>
			<div class="alert__message">${notification}</div>
			<div class="alert__close">&times;</div>
		`;
    } else if (type == 'warning') {
        newAlert.innerHTML = `
			<svg class="alert__icon" width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
				<circle class="alert__icon-path" cx="32" cy="32" r="30.5" stroke="currentColor"></circle>
				<path class="alert__icon-path alert__icon-path--type" d="M32 19V38" stroke="currentColor"></path>
				<path class="alert__icon-path alert__icon-path--type" d="M32 41L32 45" stroke="currentColor"></path>
			</svg>
			<div class="alert__message">${notification}</div>
			<div class="alert__close">&times;</div>
		`;
    } else {
        newAlert.innerHTML = `
			<svg class="alert__icon" width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
      <circle class="alert__icon-path" cx="32" cy="32" r="30.5" fill="currentColor" style="opacity: .2;"></circle>
      <circle class="alert__icon-path" cx="32" cy="32" r="30.5" stroke="currentColor"></circle>
    </svg>
			<div class="alert__message">${notification}</div>
			<div class="alert__close">&times;</div>
		`;
    }
    wrapper.appendChild(newAlert);
    newAlert.style.transform = 'translateX(-3rem)';
    newAlert.style.opacity = '0';
    setTimeout(() => {
        newAlert.style.transform = 'translateX(0)';
        newAlert.style.opacity = '1';
    }, 100);

    closeAlertItem();
    emptyState();
};

closeAlertItem();