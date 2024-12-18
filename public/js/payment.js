document.addEventListener('DOMContentLoaded', () => {
    const dataTable = document.getElementById('dataTable').getElementsByTagName('tbody')[0];
    const searchInput = document.getElementById('searchInput');
    const dateFilter = document.getElementById('dateFilter');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const data = JSON.parse(document.getElementById('payment-data').value);

    const renderTable = (filteredData) => {
        dataTable.innerHTML = '';
        filteredData.forEach(item => {
            const row = dataTable.insertRow();
            row.innerHTML = `
                <td>${item.id}</td>
                <td>${item.name}</td>
                <td>${item.date}</td>
                <td>${item.bid}</td>
                <td>${item.over_time_bid}</td>
                <td>
                    <a href="/payment/edit/${item.id}" class="btn btn-warning">تعديل</a>
                    <form action="/payment/delete/${item.id}" method="POST" style="display:inline;">
                        <input type="hidden" name="_token" value="${csrfToken}">
                        <button type="submit" class="btn btn-danger">حذف</button>
                    </form>
                </td>
            `;
        });
    };

    const filterData = () => {
        const keyword = searchInput.value.toLowerCase();
        const dateOption = dateFilter.value;
        const now = new Date();
        const filteredData = data.filter(item => {
            const matchesKeyword = item.name.toLowerCase().includes(keyword) || item.date.toLowerCase().includes(keyword);
            const createdAt = new Date(item.created_at);
            if (isNaN(createdAt)) return false;
            let matchesDate = true;
            if (dateOption === 'day') matchesDate = createdAt.toDateString() === now.toDateString();
            if (dateOption === 'week') matchesDate = (now.getTime() - createdAt.getTime()) <= 7 * 24 * 60 * 60 * 1000;
            if (dateOption === 'month') matchesDate = now.getMonth() === createdAt.getMonth() && now.getFullYear() === createdAt.getFullYear();
            if (dateOption === 'year') matchesDate = now.getFullYear() === createdAt.getFullYear();
            return matchesKeyword && matchesDate;
        });
        renderTable(filteredData);
    };

    renderTable(data);

    searchInput.addEventListener('input', filterData);
    dateFilter.addEventListener('change', filterData);
});
