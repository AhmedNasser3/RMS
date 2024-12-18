
<div class="sidebar">
    <div class="sidebar_container">
        <div class="sidebar_content">
            <div class="sidebar_data">
                <div class="hamburger" onclick="toggleSidebar()">
                    <ion-icon name="ellipsis-horizontal-outline"></ion-icon>
                </div>
                <div class="sidebar_header">
                    <h2>Profile</h2>
                    <div class="sidebar_header_icon">
                        <ion-icon name="notifications-outline"></ion-icon>
                    </div>
                </div>
                <div class="sidebar_body">
                    <div class="sidebar_img">
                        <img src="https://raw.githubusercontent.com/programmercloud/analytic-dashboard/main/img/avatar.png" alt="">
                    </div>
                    <div class="sidebar_titles">
                        <h2 style="color: #f89456">{{ auth()->check() ? auth()->user()->name : 'User' }}</h2>
                        <p>Web Developer</p>
                    </div>
                </div>
                <div class="activity">
                    <div class="activity_title">
                        <h3>Activity</h3>
                        <p>View All </p>
                    </div>
                    <div class="activity_icons">
                        <div class="activity_bucket">
                            <div class="activity_icon">
              <ion-icon name="wallet-outline"></ion-icon>
                            </div>
                            <div class="activity_description">
                                <h3>Earning </h3>
                                <p>125$</p>
                            </div>
                            <div class="activity_time">
                                <h4>2024/12/16</h4>
                            </div>
                        </div>
                        <div class="activity_bucket">
                            <div class="activity_icon">
              <ion-icon name="wallet-outline"></ion-icon>
                            </div>
                            <div class="activity_description">
                                <h3>Earning </h3>
                                <p>135$</p>
                            </div>
                            <div class="activity_time">
                                <h4>2024/12/14</h4>
                            </div>
                        </div>
                        <div class="activity_bucket">
                            <div class="activity_icon">
              <ion-icon name="wallet-outline"></ion-icon>
                            </div>
                            <div class="activity_description">
                                <h3>Earning </h3>
                                <p>135$</p>
                            </div>
                            <div class="activity_time">
                                <h4>2024/12/14</h4>
                            </div>
                        </div>
                        <div class="activity_bucket">
                            <div class="activity_icon">
              <ion-icon name="wallet-outline"></ion-icon>
                            </div>
                            <div class="activity_description">
                                <h3>Earning </h3>
                                <p>135$</p>
                            </div>
                            <div class="activity_time">
                                <h4>2024/12/14</h4>
                            </div>
                        </div>
                        <div class="activity_bucket">
                            <div class="activity_icon">
              <ion-icon name="wallet-outline"></ion-icon>
                            </div>
                            <div class="activity_description">
                                <h3>Earning </h3>
                                <p>135$</p>
                            </div>
                            <div class="activity_time">
                                <h4>2024/12/14</h4>
                            </div>
                        </div>
                        <div class="activity_bucket">
                            <div class="activity_icon">
              <ion-icon name="wallet-outline"></ion-icon>
                            </div>
                            <div class="activity_description">
                                <h3>Earning </h3>
                                <p>135$</p>
                            </div>
                            <div class="activity_time">
                                <h4>2024/12/14</h4>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function toggleSidebar() {
        const sidebar = document.querySelector('.sidebar');
        // إضافة أو إزالة الكلاس 'open' لفتح أو غلق السايد بار
        sidebar.classList.toggle('open');
    }
</script>
