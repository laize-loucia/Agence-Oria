window.addEventListener("DOMContentLoaded", init, false);

function init() {

  const elForm = document.querySelector('section#contact form#contact-form');

  elForm.addEventListener('submit', (e) => {
    handleContactSubmit(e, this);
  }, false);
  
  async function handleContactSubmit(e) {
    e.preventDefault();
    //console.log("> Prevented form submition!");
		const elPopUp = openSendingMessagePopUp();
    const elSubmittedForm = e.target;
    const formData = new FormData(elSubmittedForm);

    const wasEmailSent = await sendMail(formData);
    /*const wasEmailSent = false;
		console.log('Was email sent:');
    console.log(wasEmailSent);*/

		if (wasEmailSent) {
			elPopUp.setAttribute('data-status', 'successed');
			removeFormContent(elSubmittedForm);
		} else {
			elPopUp.setAttribute('data-status', 'failed');
		}
  }

  async function sendMail(formData, fakeWait=1000) {
    const fetched = await fetch('?req=1&res=0', {
      method: 'post',
    	body: formData
    });
		const wasEmailSent = ((await fetched.text()).toLowerCase() === 'true');
		console.log(wasEmailSent);
		if (fakeWait!==null) {
			await new Promise(r => setTimeout(r, fakeWait));
		}
    return wasEmailSent;
  }

	function removeFormContent(elTargetForm) {
		const elsInput = elTargetForm.querySelectorAll(`input, textarea`);
    elsInput.forEach((elInput) => {
      elInput.value = "";
    });
	}

	function openSendingMessagePopUp() {
		const elBody = document.querySelector(`body`);
		const popUpContainerId = 'popUpContainer';
		const popUpClassName = 'popUp';
		let elPopUpContainer = document.querySelector(`body > #${popUpContainerId}`);
		if (!elPopUpContainer) {
			elPopUpContainer = document.createElement('section');
			elPopUpContainer.id = popUpContainerId;
			elBody.append(elPopUpContainer);
		}
		
		const elPopUp = document.createElement('div');
		elPopUp.classList.add(popUpClassName);
		elPopUp.classList.add('sending-message');
		elPopUp.setAttribute('data-status', 'pending');
		
		const elQuitBtn = document.createElement('div');
		elQuitBtn.classList.add('btn-close');
		elPopUp.append(elQuitBtn);
		const elStatusInfo = document.createElement('div');
		elStatusInfo.classList.add('status-info');

		elStatusInfo.innerHTML = `<div class="animated-sending">
			<div>
				<div></div>
				<div></div>
				<div></div>
			</div>
			<div>
				<div></div>
			</div>
		</div>
		<div class="animated-success">
			<img src="public/img/icon-tick-1.svg"/>
		</div>
		<div class="animated-fail">
			<img src="public/img/icon-error-1.svg"/>
		</div>`;


		elPopUp.append(elStatusInfo);
		elPopUpContainer.append(elPopUp);

		elBody.append(elPopUpContainer);

		//const elQuitBtn = elPopUpContainer.querySelector(`.${popUpClassName}::after`);
		elQuitBtn.addEventListener('click', () => {
			if (elPopUpContainer.children.length > 1) {
				elPopUp.remove();
			} else {
				elPopUpContainer.remove();
			}
		}, false);

		elPopUpContainer.addEventListener('click', (e) => {
			if (e.target.id==popUpContainerId) {
				if (elPopUpContainer.children.length > 1) {
					const elLastPopUp = e.target.querySelector(`.${popUpClassName}:last-of-type`);
					elLastPopUp.remove();
				} else {
					e.target.remove();
				}
			}
		}, false);
		
		/*elPopUp.addEventListener('click', (e) => {		// DEBUGGGGGG
			if (elPopUp.getAttribute('data-status')=='pending') {
				//elPopUp.setAttribute('data-status', 'successed');
				elPopUp.setAttribute('data-status', 'failed');
			} else {
				elPopUp.setAttribute('data-status', 'pending');
			}
		}, false);*/

		return elPopUp;
	}

}