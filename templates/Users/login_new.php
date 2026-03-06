<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RFQ</title>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
    <style>
        :root {
            --bg-primary: #0a0c14;
            --bg-secondary: #0f1220;
            --bg-card: #141829;
            --bg-card-hover: #1a1f36;
            --border: #1e2540;
            --border-light: #252d4a;
            --text-primary: #e8eaf6;
            --text-secondary: #8892b0;
            --text-muted: #4a5580;
            --accent: #4f7cff;
            --accent-glow: rgba(79, 124, 255, 0.3);
            --accent-secondary: #7c3aed;
            --success: #10b981;
            --success-bg: rgba(16, 185, 129, 0.1);
            --warning: #f59e0b;
            --warning-bg: rgba(245, 158, 11, 0.1);
            --danger: #ef4444;
            --danger-bg: rgba(239, 68, 68, 0.1);
            --info: #06b6d4;
            --info-bg: rgba(6, 182, 212, 0.1);
            --sidebar-w: 260px;
            --header-h: 64px;
            --radius: 12px;
            --radius-sm: 8px;
            --shadow: 0 4px 24px rgba(0, 0, 0, 0.4);
            --font-display: 'Syne', sans-serif;
            --font-body: 'DM Sans', sans-serif;
        }

        [data-theme="light"] {
            --bg-primary: #f0f2f8;
            --bg-secondary: #ffffff;
            --bg-card: #ffffff;
            --bg-card-hover: #f5f7ff;
            --border: #e2e8f0;
            --border-light: #edf2f7;
            --text-primary: #1a202c;
            --text-secondary: #4a5568;
            --text-muted: #a0aec0;
            --accent: #4f7cff;
            --accent-glow: rgba(79, 124, 255, 0.15);
            --shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box
        }

        body {
            font-family: var(--font-body);
            background: var(--bg-primary);
            color: var(--text-primary);
            min-height: 100vh;
            overflow-x: hidden
        }

        ::-webkit-scrollbar {
            width: 6px
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-secondary)
        }

        ::-webkit-scrollbar-thumb {
            background: var(--border-light);
            border-radius: 3px
        }

        /* LOGIN */
        #login-screen {
            position: fixed;
            inset: 0;
            background: var(--bg-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000
        }

        .login-bg {
            position: absolute;
            inset: 0;
            overflow: hidden
        }

        .login-bg::before {
            content: '';
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(79, 124, 255, 0.15) 0%, transparent 70%);
            top: -200px;
            left: -200px;
            animation: float 8s ease-in-out infinite
        }

        .login-bg::after {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(124, 58, 237, 0.1) 0%, transparent 70%);
            bottom: -150px;
            right: -150px;
            animation: float 10s ease-in-out infinite reverse
        }

        @keyframes float {

            0%,
            100% {
                transform: translate(0, 0)
            }

            50% {
                transform: translate(30px, -30px)
            }
        }

        .login-card {
            position: relative;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 48px;
            width: 100%;
            max-width: 440px;
            box-shadow: 0 24px 80px rgba(0, 0, 0, 0.5)
        }

        .login-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 32px
        }

        .login-logo-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, var(--accent), var(--accent-secondary));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px
        }

        .login-logo-text {
            font-family: var(--font-display);
            font-size: 20px;
            font-weight: 700;
            letter-spacing: -0.5px
        }

        .login-logo-sub {
            font-size: 11px;
            color: var(--text-muted);
            font-weight: 400;
            letter-spacing: 1px;
            text-transform: uppercase
        }

        .login-title {
            font-family: var(--font-display);
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
            letter-spacing: -0.5px
        }

        .login-subtitle {
            color: var(--text-secondary);
            font-size: 14px;
            margin-bottom: 32px
        }

        .form-group {
            margin-bottom: 20px
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            color: var(--text-secondary);
            margin-bottom: 8px
        }

        .form-control {
            width: 100%;
            background: var(--bg-secondary);
            border: 1px solid var(--border);
            color: var(--text-primary);
            padding: 12px 16px;
            border-radius: var(--radius-sm);
            font-size: 14px;
            font-family: var(--font-body);
            transition: all 0.2s;
            outline: none
        }

        .form-control:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--accent-glow)
        }

        .quick-login {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            margin-bottom: 24px
        }

        .ql-btn {
            background: var(--bg-secondary);
            border: 1px solid var(--border);
            color: var(--text-secondary);
            padding: 10px;
            border-radius: var(--radius-sm);
            cursor: pointer;
            font-size: 12px;
            font-family: var(--font-body);
            transition: all 0.2s;
            text-align: center
        }

        .ql-btn:hover {
            border-color: var(--accent);
            color: var(--accent);
            background: var(--accent-glow)
        }

        .btn-primary {
            width: 100%;
            background: linear-gradient(135deg, var(--accent), var(--accent-secondary));
            color: #fff;
            border: none;
            padding: 14px;
            border-radius: var(--radius-sm);
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            font-family: var(--font-body);
            transition: all 0.2s;
            position: relative;
            overflow: hidden
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 24px var(--accent-glow)
        }

        .btn-primary::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(transparent, rgba(255, 255, 255, 0.05));
            pointer-events: none
        }

        .login-quick-label {
            font-size: 12px;
            color: var(--text-muted);
            text-align: center;
            margin-bottom: 12px
        }

        /* LAYOUT */
        #app {
            display: none;
            min-height: 100vh
        }

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            width: var(--sidebar-w);
            background: var(--bg-secondary);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            z-index: 100;
            transition: all 0.3s
        }

        .sidebar-logo {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 12px
        }

        .sidebar-logo-icon {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--accent), var(--accent-secondary));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            flex-shrink: 0
        }

        .sidebar-logo-text {
            font-family: var(--font-display);
            font-size: 16px;
            font-weight: 700;
            letter-spacing: -0.3px
        }

        .sidebar-logo-sub {
            font-size: 10px;
            color: var(--text-muted);
            letter-spacing: 1px;
            text-transform: uppercase
        }

        .sidebar-nav {
            flex: 1;
            overflow-y: auto;
            padding: 16px 0
        }

        .nav-section {
            padding: 0 16px;
            margin-bottom: 24px
        }

        .nav-section-title {
            font-size: 10px;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 1.5px;
            padding: 0 8px;
            margin-bottom: 8px
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            border-radius: var(--radius-sm);
            cursor: pointer;
            transition: all 0.15s;
            color: var(--text-secondary);
            font-size: 14px;
            font-weight: 500;
            position: relative;
            margin-bottom: 2px
        }

        .nav-item:hover {
            background: var(--bg-card-hover);
            color: var(--text-primary)
        }

        .nav-item.active {
            background: var(--accent-glow);
            color: var(--accent);
            font-weight: 600
        }

        .nav-item.active::before {
            content: '';
            position: absolute;
            left: -16px;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 20px;
            background: var(--accent);
            border-radius: 0 4px 4px 0
        }

        .nav-item i {
            width: 20px;
            text-align: center;
            font-size: 15px
        }

        .nav-badge {
            margin-left: auto;
            background: var(--danger);
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            padding: 2px 6px;
            border-radius: 10px
        }

        .sidebar-footer {
            padding: 16px;
            border-top: 1px solid var(--border)
        }

        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: var(--radius-sm);
            background: var(--bg-card);
            border: 1px solid var(--border)
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), var(--accent-secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 700;
            flex-shrink: 0
        }

        .user-name {
            font-size: 13px;
            font-weight: 600;
            line-height: 1.2
        }

        .user-role {
            font-size: 11px;
            color: var(--text-muted)
        }

        .main-content {
            margin-left: var(--sidebar-w);
            min-height: 100vh;
            display: flex;
            flex-direction: column
        }

        .topbar {
            height: var(--header-h);
            background: var(--bg-secondary);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            padding: 0 24px;
            gap: 16px;
            position: sticky;
            top: 0;
            z-index: 50
        }

        .topbar-title {
            font-family: var(--font-display);
            font-size: 18px;
            font-weight: 700;
            flex: 1
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 12px
        }

        .icon-btn {
            width: 36px;
            height: 36px;
            border: 1px solid var(--border);
            background: var(--bg-card);
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--text-secondary);
            transition: all 0.2s;
            position: relative
        }

        .icon-btn:hover {
            border-color: var(--accent);
            color: var(--accent)
        }

        .notif-dot {
            position: absolute;
            top: 6px;
            right: 6px;
            width: 8px;
            height: 8px;
            background: var(--danger);
            border-radius: 50%;
            border: 2px solid var(--bg-secondary)
        }

        .content-area {
            flex: 1;
            padding: 24px;
            overflow-y: auto
        }

        /* PAGES */
        .page {
            display: none;
            animation: fadeIn 0.2s ease
        }

        .page.active {
            display: block
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(8px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        /* KPI CARDS */
        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 24px
        }

        .kpi-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 20px;
            position: relative;
            overflow: hidden;
            transition: all 0.2s
        }

        .kpi-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow);
            border-color: var(--border-light)
        }

        .kpi-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            border-radius: var(--radius) var(--radius) 0 0
        }

        .kpi-card.blue::before {
            background: linear-gradient(90deg, var(--accent), #60a5fa)
        }

        .kpi-card.green::before {
            background: linear-gradient(90deg, var(--success), #34d399)
        }

        .kpi-card.purple::before {
            background: linear-gradient(90deg, var(--accent-secondary), #a78bfa)
        }

        .kpi-card.orange::before {
            background: linear-gradient(90deg, var(--warning), #fbbf24)
        }

        .kpi-label {
            font-size: 12px;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
            margin-bottom: 12px
        }

        .kpi-value {
            font-family: var(--font-display);
            font-size: 32px;
            font-weight: 700;
            line-height: 1;
            margin-bottom: 8px
        }

        .kpi-trend {
            font-size: 12px;
            display: flex;
            align-items: center;
            gap: 4px
        }

        .kpi-trend.up {
            color: var(--success)
        }

        .kpi-trend.down {
            color: var(--danger)
        }

        .kpi-icon {
            position: absolute;
            right: 20px;
            top: 20px;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px
        }

        .kpi-card.blue .kpi-icon {
            background: var(--info-bg);
            color: var(--accent)
        }

        .kpi-card.green .kpi-icon {
            background: var(--success-bg);
            color: var(--success)
        }

        .kpi-card.purple .kpi-icon {
            background: rgba(124, 58, 237, 0.1);
            color: var(--accent-secondary)
        }

        .kpi-card.orange .kpi-icon {
            background: var(--warning-bg);
            color: var(--warning)
        }

        /* CHARTS */
        .charts-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 16px;
            margin-bottom: 24px
        }

        .chart-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 24px
        }

        .chart-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px
        }

        .chart-title {
            font-family: var(--font-display);
            font-size: 15px;
            font-weight: 600
        }

        .chart-subtitle {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 2px
        }

        /* AI PANEL */
        .ai-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 24px
        }

        .ai-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 20px
        }

        .ai-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 16px
        }

        .ai-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: linear-gradient(135deg, var(--accent), var(--accent-secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px
        }

        .ai-title {
            font-size: 14px;
            font-weight: 600;
            font-family: var(--font-display)
        }

        /* RISK SCORE */
        .risk-meter {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 12px
        }

        .risk-gauge {
            flex: 1;
            height: 10px;
            background: var(--bg-secondary);
            border-radius: 5px;
            overflow: hidden;
            position: relative
        }

        .risk-fill {
            height: 100%;
            border-radius: 5px;
            transition: width 1s ease;
            position: relative
        }

        .risk-fill.low {
            background: linear-gradient(90deg, var(--success), #34d399)
        }

        .risk-fill.medium {
            background: linear-gradient(90deg, var(--warning), #fbbf24)
        }

        .risk-fill.high {
            background: linear-gradient(90deg, var(--danger), #f87171)
        }

        .risk-label {
            font-size: 13px;
            font-weight: 600;
            min-width: 60px;
            text-align: right
        }

        .risk-label.low {
            color: var(--success)
        }

        .risk-label.medium {
            color: var(--warning)
        }

        .risk-label.high {
            color: var(--danger)
        }

        .risk-item {
            display: flex;
            flex-direction: column;
            gap: 6px;
            padding: 10px 0;
            border-bottom: 1px solid var(--border)
        }

        .risk-item:last-child {
            border-bottom: none
        }

        .risk-item-header {
            display: flex;
            align-items: center;
            justify-content: space-between
        }

        .risk-item-name {
            font-size: 13px;
            font-weight: 500
        }

        /* ACTIVITY FEED */
        .activity-feed {
            display: flex;
            flex-direction: column;
            gap: 0
        }

        .activity-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid var(--border)
        }

        .activity-item:last-child {
            border-bottom: none
        }

        .activity-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            flex-shrink: 0;
            margin-top: 5px
        }

        .activity-dot.blue {
            background: var(--accent)
        }

        .activity-dot.green {
            background: var(--success)
        }

        .activity-dot.orange {
            background: var(--warning)
        }

        .activity-dot.red {
            background: var(--danger)
        }

        .activity-dot.purple {
            background: var(--accent-secondary)
        }

        .activity-text {
            font-size: 13px;
            line-height: 1.5
        }

        .activity-text strong {
            color: var(--text-primary)
        }

        .activity-time {
            font-size: 11px;
            color: var(--text-muted);
            margin-top: 2px
        }

        /* TABLES */
        .table-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden
        }

        .table-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 20px;
            border-bottom: 1px solid var(--border)
        }

        .table-header-left {
            display: flex;
            align-items: center;
            gap: 12px
        }

        .table-title {
            font-family: var(--font-display);
            font-size: 15px;
            font-weight: 600
        }

        .search-input {
            background: var(--bg-secondary);
            border: 1px solid var(--border);
            color: var(--text-primary);
            padding: 8px 14px 8px 36px;
            border-radius: var(--radius-sm);
            font-size: 13px;
            font-family: var(--font-body);
            outline: none;
            width: 220px;
            transition: all 0.2s
        }

        .search-input:focus {
            border-color: var(--accent);
            width: 260px
        }

        .search-wrapper {
            position: relative
        }

        .search-wrapper i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 12px
        }

        .btn {
            padding: 8px 16px;
            border-radius: var(--radius-sm);
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            border: 1px solid var(--border);
            font-family: var(--font-body);
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px
        }

        .btn-accent {
            background: var(--accent);
            color: #fff;
            border-color: var(--accent)
        }

        .btn-accent:hover {
            background: #3d6ae8;
            transform: translateY(-1px)
        }

        .btn-outline {
            background: transparent;
            color: var(--text-secondary)
        }

        .btn-outline:hover {
            border-color: var(--accent);
            color: var(--accent)
        }

        .btn-success {
            background: var(--success);
            color: #fff;
            border-color: var(--success)
        }

        .btn-danger {
            background: var(--danger);
            color: #fff;
            border-color: var(--danger)
        }

        .btn-sm {
            padding: 5px 10px;
            font-size: 12px
        }

        table {
            width: 100%;
            border-collapse: collapse
        }

        th {
            background: var(--bg-secondary);
            padding: 10px 16px;
            text-align: left;
            font-size: 11px;
            font-weight: 600;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.8px;
            border-bottom: 1px solid var(--border)
        }

        td {
            padding: 13px 16px;
            font-size: 13px;
            border-bottom: 1px solid var(--border);
            color: var(--text-secondary)
        }

        tr:last-child td {
            border-bottom: none
        }

        tr:hover td {
            background: var(--bg-card-hover);
            color: var(--text-primary)
        }

        .td-primary {
            color: var(--text-primary);
            font-weight: 500
        }

        /* BADGES */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.3px
        }

        .badge::before {
            content: '';
            width: 5px;
            height: 5px;
            border-radius: 50%
        }

        .badge-success {
            background: var(--success-bg);
            color: var(--success)
        }

        .badge-success::before {
            background: var(--success)
        }

        .badge-warning {
            background: var(--warning-bg);
            color: var(--warning)
        }

        .badge-warning::before {
            background: var(--warning)
        }

        .badge-danger {
            background: var(--danger-bg);
            color: var(--danger)
        }

        .badge-danger::before {
            background: var(--danger)
        }

        .badge-info {
            background: var(--info-bg);
            color: var(--info)
        }

        .badge-info::before {
            background: var(--info)
        }

        .badge-muted {
            background: var(--bg-secondary);
            color: var(--text-muted)
        }

        .badge-muted::before {
            background: var(--text-muted)
        }

        .badge-accent {
            background: var(--accent-glow);
            color: var(--accent)
        }

        .badge-accent::before {
            background: var(--accent)
        }

        /* MODAL */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(4px);
            z-index: 500;
            display: none;
            align-items: center;
            justify-content: center
        }

        .modal-overlay.open {
            display: flex;
            animation: fadeIn 0.2s
        }

        .modal {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 16px;
            width: 100%;
            max-width: 760px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 32px 80px rgba(0, 0, 0, 0.5)
        }

        .modal-header {
            padding: 24px 28px 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            background: var(--bg-card);
            z-index: 1;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--border)
        }

        .modal-title {
            font-family: var(--font-display);
            font-size: 18px;
            font-weight: 700
        }

        .modal-close {
            width: 32px;
            height: 32px;
            border: 1px solid var(--border);
            background: var(--bg-secondary);
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted)
        }

        .modal-close:hover {
            color: var(--danger);
            border-color: var(--danger)
        }

        .modal-body {
            padding: 24px 28px
        }

        .modal-footer {
            padding: 0 28px 24px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 12px
        }

        /* FORMS */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 16px
        }

        .form-row.single {
            grid-template-columns: 1fr
        }

        .form-row.triple {
            grid-template-columns: 1fr 1fr 1fr
        }

        .form-label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px
        }

        .form-input {
            width: 100%;
            background: var(--bg-secondary);
            border: 1px solid var(--border);
            color: var(--text-primary);
            padding: 10px 14px;
            border-radius: var(--radius-sm);
            font-size: 14px;
            font-family: var(--font-body);
            outline: none;
            transition: all 0.2s
        }

        .form-input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--accent-glow)
        }

        select.form-input {
            cursor: pointer
        }

        textarea.form-input {
            resize: vertical;
            min-height: 80px
        }

        .form-section {
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border)
        }

        .form-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0
        }

        .form-section-title {
            font-size: 13px;
            font-weight: 700;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            gap: 8px
        }

        .form-section-title i {
            color: var(--accent)
        }

        /* SECTION TITLES */
        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px
        }

        .section-title {
            font-family: var(--font-display);
            font-size: 16px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 8px
        }

        .section-title i {
            color: var(--accent);
            font-size: 14px
        }

        .section-desc {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 2px
        }

        /* VENDOR CARDS */
        .vendor-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px
        }

        .vendor-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 20px;
            transition: all 0.2s;
            cursor: pointer
        }

        .vendor-card:hover {
            transform: translateY(-2px);
            border-color: var(--accent);
            box-shadow: 0 8px 24px var(--accent-glow)
        }

        .vendor-avatar {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--accent), var(--accent-secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 12px
        }

        .vendor-name {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 4px
        }

        .vendor-cat {
            font-size: 11px;
            color: var(--text-muted);
            margin-bottom: 12px
        }

        .vendor-stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px
        }

        .vendor-stat {
            background: var(--bg-secondary);
            border-radius: var(--radius-sm);
            padding: 8px;
            text-align: center
        }

        .vendor-stat-val {
            font-size: 16px;
            font-weight: 700;
            font-family: var(--font-display)
        }

        .vendor-stat-label {
            font-size: 10px;
            color: var(--text-muted)
        }

        /* SAP INTEGRATION */
        .sap-terminal {
            background: #0a0f0a;
            border: 1px solid #1a3a1a;
            border-radius: var(--radius);
            padding: 20px;
            font-family: 'Courier New', monospace;
            font-size: 12px;
            color: #4ade80;
            line-height: 1.8;
            max-height: 200px;
            overflow-y: auto
        }

        .sap-terminal .cmd {
            color: #86efac
        }

        .sap-terminal .resp {
            color: #d1fae5;
            opacity: 0.8
        }

        .sap-terminal .err {
            color: #f87171
        }

        .sap-terminal .prompt {
            color: #6ee7b7;
            margin-right: 8px
        }

        /* TOAST */
        .toast-container {
            position: fixed;
            top: 80px;
            right: 24px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 8px
        }

        .toast {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 14px 18px;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: var(--shadow);
            animation: slideIn 0.3s ease;
            font-size: 13px;
            min-width: 280px;
            max-width: 380px
        }

        .toast.success {
            border-left: 3px solid var(--success)
        }

        .toast.error {
            border-left: 3px solid var(--danger)
        }

        .toast.info {
            border-left: 3px solid var(--accent)
        }

        .toast.warning {
            border-left: 3px solid var(--warning)
        }

        .toast-icon {
            font-size: 16px
        }

        .toast.success .toast-icon {
            color: var(--success)
        }

        .toast.error .toast-icon {
            color: var(--danger)
        }

        .toast.info .toast-icon {
            color: var(--accent)
        }

        .toast.warning .toast-icon {
            color: var(--warning)
        }

        @keyframes slideIn {
            from {
                transform: translateX(120%);
                opacity: 0
            }

            to {
                transform: translateX(0);
                opacity: 1
            }
        }

        /* NOTIFICATIONS PANEL */
        .notif-panel {
            position: fixed;
            right: 0;
            top: 0;
            bottom: 0;
            width: 360px;
            background: var(--bg-secondary);
            border-left: 1px solid var(--border);
            z-index: 200;
            transform: translateX(100%);
            transition: transform 0.3s;
            padding: 24px
        }

        .notif-panel.open {
            transform: translateX(0)
        }

        .notif-panel-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px
        }

        /* REPORTS */
        .report-tabs {
            display: flex;
            gap: 4px;
            background: var(--bg-secondary);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 4px;
            margin-bottom: 20px
        }

        .report-tab {
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            color: var(--text-muted)
        }

        .report-tab.active {
            background: var(--accent);
            color: #fff
        }

        .report-tab:hover:not(.active) {
            color: var(--text-primary)
        }

        /* SETTINGS */
        .settings-grid {
            display: grid;
            grid-template-columns: 240px 1fr;
            gap: 20px
        }

        .settings-nav {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 8px;
            height: fit-content
        }

        .settings-nav-item {
            padding: 10px 14px;
            border-radius: var(--radius-sm);
            cursor: pointer;
            font-size: 14px;
            transition: all 0.2s;
            color: var(--text-secondary);
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 2px
        }

        .settings-nav-item.active,
        .settings-nav-item:hover {
            background: var(--bg-secondary);
            color: var(--text-primary)
        }

        .settings-nav-item.active {
            color: var(--accent)
        }

        .settings-panel {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 24px
        }

        .settings-title {
            font-family: var(--font-display);
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 6px
        }

        .settings-desc {
            font-size: 13px;
            color: var(--text-muted);
            margin-bottom: 24px
        }

        /* TOGGLE */
        .toggle {
            position: relative;
            display: inline-block;
            width: 44px;
            height: 24px
        }

        .toggle input {
            opacity: 0;
            width: 0;
            height: 0
        }

        .toggle-slider {
            position: absolute;
            cursor: pointer;
            inset: 0;
            background: var(--border-light);
            border-radius: 24px;
            transition: all 0.3s
        }

        .toggle-slider::before {
            content: '';
            position: absolute;
            height: 18px;
            width: 18px;
            left: 3px;
            bottom: 3px;
            background: #fff;
            border-radius: 50%;
            transition: all 0.3s
        }

        .toggle input:checked+.toggle-slider {
            background: var(--accent)
        }

        .toggle input:checked+.toggle-slider::before {
            transform: translateX(20px)
        }

        /* AI SCORES */
        .score-bar {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 8px
        }

        .score-bar-label {
            font-size: 12px;
            color: var(--text-secondary);
            min-width: 120px
        }

        .score-bar-track {
            flex: 1;
            height: 6px;
            background: var(--bg-secondary);
            border-radius: 3px;
            overflow: hidden
        }

        .score-bar-fill {
            height: 100%;
            border-radius: 3px;
            transition: width 1.5s ease
        }

        .score-bar-val {
            font-size: 12px;
            font-weight: 600;
            min-width: 36px;
            text-align: right
        }

        /* PAGINATION */
        .pagination {
            display: flex;
            align-items: center;
            gap: 4px;
            padding: 16px;
            border-top: 1px solid var(--border);
            justify-content: center
        }

        .page-btn {
            width: 32px;
            height: 32px;
            border: 1px solid var(--border);
            background: var(--bg-secondary);
            border-radius: var(--radius-sm);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 500;
            color: var(--text-secondary);
            transition: all 0.2s
        }

        .page-btn:hover,
        .page-btn.active {
            border-color: var(--accent);
            color: var(--accent);
            background: var(--accent-glow)
        }

        /* RESPONSIVE */
        @media(max-width:1200px) {
            .kpi-grid {
                grid-template-columns: repeat(2, 1fr)
            }

            .vendor-grid {
                grid-template-columns: repeat(2, 1fr)
            }
        }

        @media(max-width:768px) {
            .sidebar {
                transform: translateX(-100%)
            }

            .main-content {
                margin-left: 0
            }

            .kpi-grid {
                grid-template-columns: 1fr
            }

            .charts-grid {
                grid-template-columns: 1fr
            }
        }

        /* WEBSOCKET INDICATOR */
        .ws-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--success);
            animation: pulse 2s infinite
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4)
            }

            50% {
                opacity: 0.8;
                box-shadow: 0 0 0 6px rgba(16, 185, 129, 0)
            }
        }

        /* PROGRESS */
        .progress {
            height: 6px;
            background: var(--bg-secondary);
            border-radius: 3px;
            overflow: hidden
        }

        .progress-bar {
            height: 100%;
            border-radius: 3px;
            background: linear-gradient(90deg, var(--accent), var(--accent-secondary));
            transition: width 0.5s
        }

        /* SAP STATUS */
        .sap-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 10px;
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            color: var(--success)
        }

        .sap-badge i {
            font-size: 10px
        }

        /* VENDOR SCORE */
        .vs-ring {
            position: relative;
            width: 64px;
            height: 64px
        }

        .vs-ring svg {
            transform: rotate(-90deg)
        }

        .vs-ring .bg-circle {
            fill: none;
            stroke: var(--bg-secondary);
            stroke-width: 6
        }

        .vs-ring .score-circle {
            fill: none;
            stroke-width: 6;
            stroke-linecap: round;
            transition: stroke-dashoffset 1.5s ease
        }

        .vs-value {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 700;
            font-family: var(--font-display)
        }

        /* LINE ITEMS */
        .line-items-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px
        }

        .line-items-table th {
            background: var(--bg-secondary);
            padding: 8px 12px;
            text-align: left;
            font-size: 11px;
            font-weight: 600;
            color: var(--text-muted);
            border-bottom: 1px solid var(--border)
        }

        .line-items-table td {
            padding: 8px 12px;
            border-bottom: 1px solid var(--border)
        }

        .line-items-table tr:hover td {
            background: var(--bg-card-hover)
        }

        .tag {
            display: inline-flex;
            padding: 2px 8px;
            background: var(--accent-glow);
            color: var(--accent);
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
            margin-right: 4px
        }
    </style>
</head>

<body>
    <div id="login-screen">
        <div class="login-bg"></div>
        <div class="login-card">
            <div class="login-logo">
                <div class="login-logo-icon">🔷</div>
                <div>
                    <div class="login-logo-text">RFQ Portal</div>
                    <div class="login-logo-sub">Intelligence Platform</div>
                </div>
            </div>
            <h1 class="login-title">Welcome back</h1>
            <!-- <p class="login-subtitle">Sign in to access your procurement dashboard</p> -->
            <form action="<?= $this->Url->build(['controller' => 'users', 'action' => 'login']) ?>" method="POST">
              <input type="hidden" name="_csrfToken" value="<?= h($this->request->getAttribute('csrfToken')) ?>">
                <div class="form-group">
                    <label>Email Address</label>
                    <input class="form-control" name="email" id="login-email" type="email" placeholder="user@demo.com">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input class="form-control" name="password" id="login-pwd" type="password" placeholder="••••••••">
                </div>
                <button class="btn-primary" type="submit"><i class="fa fa-sign-in-alt"></i> &nbsp;Sign In to Portal</button>
            </form>
        </div>
    </div>
</body>

</html>