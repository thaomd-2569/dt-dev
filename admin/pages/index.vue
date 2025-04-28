<!-- pages/index.vue -->
<template>
    <div>
        <h1>Dashboard</h1>
        <div class="dashboard-stats">
            <div class="stat-card">
                <h3>Total Users</h3>
                <p class="stat-value">1,254</p>
            </div>
            <div class="stat-card">
                <h3>New Orders</h3>
                <p class="stat-value">34</p>
            </div>
            <div class="stat-card">
                <h3>Revenue</h3>
                <p class="stat-value">$15,240</p>
            </div>
            <div class="stat-card">
                <h3>Conversion Rate</h3>
                <p class="stat-value">3.2%</p>
            </div>
        </div>
        <div class="dashboard-charts">
            <p>Recent activity and analytics charts will be displayed here</p>
        </div>
    </div>
</template>

<style scoped>
.dashboard-stats {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.stat-card {
    background-color: white;
    border-radius: 8px;
    padding: 1.5rem;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.08);
}

.stat-card h3 {
    margin: 0 0 0.5rem 0;
    color: #6c757d;
    font-size: 1rem;
}

.stat-value {
    margin: 0;
    font-size: 1.8rem;
    font-weight: 600;
    color: #343a40;
}

.dashboard-charts {
    background-color: white;
    border-radius: 8px;
    padding: 1.5rem;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.08);
}
</style>
