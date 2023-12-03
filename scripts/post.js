async function submitForm() {
	event.preventDefault();
	const numberValue = document.getElementById('number').value;
	const content = document.getElementById('content').value;

	if (!numberValue.trim().length) {
		alert('Введіть номер блоку.');
		return;
	}

	if (+numberValue < 1 || +numberValue > 18) {
		alert('Такого блоку не існує.');
		return;
	}

	const body = { id: +numberValue, content };
	await fetch('http://localhost:8000/scripts/blocks.php', {
		method: 'POST',
		headers: {
			'Content-Type': 'application/x-www-form-urlencoded',
		},
		body: JSON.stringify(body),
	});

	alert('Вміст блоку змінено.');
}