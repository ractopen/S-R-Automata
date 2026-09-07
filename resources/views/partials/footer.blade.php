<style>
    .site-footer {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        padding: 60px 40px;
        background-color: #0b0c0e; 
        display: flex;
        justify-content: center;
        
    }
    .footer-card {
        background-color: #0b0c0e;
        width: 100%;
        max-width: 1240px;
        border-radius: 24px;
        padding: 50px 60px 0 60px;
        position: relative;
        overflow: hidden;
        color: #ffffff;
        box-sizing: border-box;
    }
    .footer-top {
        display: flex;
        justify-content: space-between;
        gap: 40px;
        margin-bottom: 60px;
    }
    .footer-brand {
        max-width: 320px;
    }
    .footer-logo {
        font-size: 24px;
        font-weight: 700;
        letter-spacing: 1px;
        margin: 0 0 16px 0;
        color: #ffffff;
    }
    .footer-desc {
        font-size: 13px;
        color: #8e8e93;
        line-height: 1.6;
        margin: 0;
        padding: 0 !important;
    }
    .footer-nav {
        display: flex;
        gap: 48px;
    }
    .footer-col h4 {
        font-size: 13px;
        font-weight: 600;
        color: #ffffff;
        margin: 0 0 16px 0;
    }
    .footer-col ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .footer-col li {
        margin-bottom: 10px;
    }
    .footer-col a {
        color: #8e8e93;
        font-size: 13px;
        text-decoration: none;
        transition: color 0.2s ease;
    }
    .footer-col a:hover {
        color: #ffffff;
    }
    .footer-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 12px;
        color: #636366;
        margin-bottom: 20px;
        position: relative;
        z-index: 2;
    }
    .footer-meta p {
        margin: 0;
        padding: 0 !important; 
        color: inherit;
    }
    .footer-giant-text {
        font-size: 14vw; 
        font-weight: 800;
        text-align: center;
        line-height: 0.8;
        letter-spacing: 2px;
        user-select: none;
        margin-bottom: -0.1em; 
        background: linear-gradient(180deg, #38ef7d 0%, #11998e 45%, rgba(11, 12, 14, 0.95) 90%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        opacity: 0.85;
    }
</style>

<footer class="site-footer">
    <div class="footer-card">
        <!-- Top Navigation Area -->
        <div class="footer-top">
            <div class="footer-brand">
                <h2 class="footer-logo">RYSE</h2>
                <p class="footer-desc">
                    Basta something paragraph
                </p>
            </div>

            <div class="footer-nav">
                <div class="footer-col">
                    <h4>Quick link</h4>
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li><a href="#">About us</a></li>
                        <li><a href="#">Contact us</a></li>
                        <li><a href="#">License</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Company</h4>
                    <ul>
                        <li><a href="#">Service</a></li>
                        <li><a href="#">Service details</a></li>
                        <li><a href="#">Project</a></li>
                        <li><a href="#">Project details</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Others</h4>
                    <ul>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Blog details</a></li>
                        <li><a href="#">404</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Social</h4>
                    <ul>
                        <li><a href="#">Facebook</a></li>
                        <li><a href="#">LinkedIn</a></li>
                        <li><a href="#">Instagram</a></li>
                        <li><a href="#">Twitter</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Copyright Bar -->
        <div class="footer-meta">
            <p>&copy; 2026 Ryse All rights reserved.</p>
            <p>Powered by Placeholder</p>
        </div>

        <!-- Giant Gradient Watermark -->
        <div class="footer-giant-text">
            RYSE
        </div>
    </div>
</footer>