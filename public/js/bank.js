document.addEventListener('DOMContentLoaded', () => {
    const dataTable = document.getElementById('dataTable').getElementsByTagName('tbody')[0];
    const searchInput = document.getElementById('searchInput');
    const dateFilter = document.getElementById('dateFilter');

    const data = JSON.parse(document.getElementById('bank-data').value); // جلب البيانات من الحقل المخفي

    const renderTable = (filteredData) => {
        dataTable.innerHTML = '';
        filteredData.forEach(item => {
            const row = dataTable.insertRow();
            row.innerHTML = `
          <td>${item.id}</td>
          <td>${item.name}</td>
          <td>${item.date}</td>
        `;
        });
    };

    const filterData = () => {
        const keyword = searchInput.value.toLowerCase();
        const dateOption = dateFilter.value;
        const now = new Date();
        const filteredData = data.filter(item => {
            const matchesKeyword = item.name.toLowerCase().includes(keyword) || item.details.toLowerCase().includes(keyword);
            const itemDate = new Date(item.date);
            let matchesDate = true;
            if (dateOption === 'day') matchesDate = itemDate.toDateString() === now.toDateString();
            if (dateOption === 'week') matchesDate = now - itemDate <= 7 * 24 * 60 * 60 * 1000;
            if (dateOption === 'month') matchesDate = now.getMonth() === itemDate.getMonth() && now.getFullYear() === itemDate.getFullYear();
            if (dateOption === 'year') matchesDate = now.getFullYear() === itemDate.getFullYear();
            return matchesKeyword && matchesDate;
        });
        renderTable(filteredData);
    };

    renderTable(data);

    searchInput.addEventListener('input', filterData);
    dateFilter.addEventListener('change', filterData);
});
