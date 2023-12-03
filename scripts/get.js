function fillGridWithContent(jsonData) {
	jsonData.forEach(item => {
		const gridItem = document.getElementById(`item${item.id}`);

		if (gridItem) {
			const label = document.createElement('label');
			label.textContent = item.content;

			gridItem.appendChild(label);
		}
	});
}

document.addEventListener('DOMContentLoaded', async () => {
	const response = await fetch('http://localhost:8000/scripts/blocks.php');
	const { data } = await response.json();
	fillGridWithContent(data);
});