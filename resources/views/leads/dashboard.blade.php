<x-app-layout>
  <div class="container mt-5">
    <div class="text-center mb-5">
      <h2 class="fw-bold mb-2" style="font-size: 2.2rem; color: #b22222;">
        <strong>LEADS DASHBOARD</strong>
      </h2>
      <p class="text-secondary">
        Analysis of Filtered CRM Leads Performance by Category
      </p>
    </div>

    <style>
      :root {
        --main-red: #e63946;
        --main-red-dark: #b22222;
        --card-radius: 1.2rem;
        --transition: 0.3s ease;
      }

      body {
        background-color: #f9f9f9;
        font-family: 'Inter', sans-serif;
      }

      .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 1.8rem;
        padding: 0 1rem;
      }

      .stat-card {
        position: relative;
        background: #fff;
        border-radius: var(--card-radius);
        padding: 2rem;
        border: 2px solid var(--main-red-dark);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        transition: var(--transition);
        cursor: pointer;
        overflow: hidden;
      }

      .stat-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 25px rgba(178, 34, 34, 0.15);
      }

      .stat-card::before {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(
          135deg,
          rgba(230, 57, 70, 0.04),
          rgba(230, 57, 70, 0.1)
        );
        z-index: 0;
        opacity: 0;
        transition: opacity var(--transition);
      }

      .stat-card:hover::before {
        opacity: 1;
      }

      .stat-card .inner {
        position: relative;
        z-index: 2;
      }

      .stat-card h3 {
        font-size: 2.6rem;
        font-weight: 800;
        color: var(--main-red-dark);
        margin: 0;
      }

      .stat-card p {
        font-size: 1rem;
        color: #444;
        margin-top: 6px;
        letter-spacing: 0.4px;
      }

      .stat-icon {
        position: absolute;
        top: 25px;
        right: 25px;
        font-size: 3rem;
        color: var(--main-red);
        opacity: 0.15;
        transition: var(--transition);
      }

      .stat-card:hover .stat-icon {
        transform: scale(1.2) rotate(8deg);
        opacity: 0.25;
      }

      .stat-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-weight: 500;
        font-size: 0.9rem;
        padding-top: 1rem;
        border-top: 1px solid #f0f0f0;
        margin-top: 1.2rem;
        color: var(--main-red-dark);
      }

      .stat-footer i {
        font-size: 1rem;
        margin-left: 6px;
        transition: transform 0.25s ease;
      }

      .stat-card:hover .stat-footer i {
        transform: translateX(6px);
      }

      /* Efek shimmer lembut */
      .stat-card::after {
        content: "";
        position: absolute;
        top: 0;
        left: -70%;
        width: 50%;
        height: 100%;
        background: linear-gradient(
          120deg,
          transparent,
          rgba(255, 255, 255, 0.6),
          transparent
        );
        transform: skewX(-20deg);
        opacity: 0;
        transition: opacity 0.4s;
      }

      .stat-card:hover::after {
        opacity: 1;
        animation: shimmer 1.4s infinite;
      }

      @keyframes shimmer {
        0% {
          left: -70%;
        }
        100% {
          left: 120%;
        }
      }

      @media (max-width: 768px) {
        .stat-card {
          padding: 1.5rem;
        }
        .stat-card h3 {
          font-size: 2rem;
        }
      }
    </style>

    <div class="stats-container">
      @foreach($leadByCategory as $category)
        <div class="stat-card"
             onclick="window.location='{{ route('leads.byCategory', ['category' => $category->category_name]) }}'">
          <div class="inner">
            <h3>{{ $category->total }}</h3>
            <p>{{ $category->category_name }}</p>
          </div>
          <i class="bi bi-tags stat-icon"></i>
          <div class="stat-footer">
            <span>View {{ $category->category_name }} Leads</span>
            <i class="bi bi-arrow-right-circle"></i>
          </div>
        </div>
      @endforeach

      <div class="stat-card"
           onclick="window.location='{{ route('leads.index') }}'">
        <div class="inner">
          <h3>{{ $totalLeads }}</h3>
          <p>Total Leads</p>
        </div>
        <i class="bi bi-people stat-icon"></i>
        <div class="stat-footer">
          <span>View All Leads</span>
          <i class="bi bi-arrow-right-circle"></i>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
