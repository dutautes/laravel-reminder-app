@extends('templates.app')

@section('content')
    <div>
        <section class="hero-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <span class="badge-welcome">Welcome to ReminderApp</span>
                        <h1 class="hero-title">Stay Organized, Stay Productive</h1>
                        <p class="hero-subtitle">
                            Manage your tasks, collaborate with your team, and never miss a deadline. ReminderApp helps you
                            stay on top of everything that matters.
                        </p>
                        <div class="d-flex flex-wrap">
                            <a href="{{ route('signup') }}" class="btn-get-started">
                                Get Started
                                <i class="bi bi-arrow-right"></i>
                            </a>
                            <a href="#features" class="btn-learn-more">Learn More</a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="hero-image-wrapper">
                            <img src="https://images.unsplash.com/photo-1484480974693-6ca0a78fb36b?w=800&q=80"
                                alt="Task Management" class="hero-image">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="features-section" id="features">
            <div class="container">
                <h2 class="section-title">Powerful Features</h2>
                <p class="section-subtitle">Everything you need to manage your tasks and projects efficiently</p>

                <div class="row g-4">
                    <div class="col-lg-3 col-md-6">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fa-regular fa-bell"></i>
                            </div>
                            <h3 class="feature-title">Smart Reminders</h3>
                            <p class="feature-description">Never miss important tasks with intelligent reminder
                                notifications</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fa-solid fa-diagram-project"></i>
                            </div>
                            <h3 class="feature-title">Team Projects</h3>
                            <p class="feature-description">Collaborate seamlessly with your team on shared projects</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fa-solid fa-check-to-slot"></i>
                            </div>
                            <h3 class="feature-title">Task Management</h3>
                            <p class="feature-description">Organize and prioritize your tasks with ease</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fa-solid fa-bolt"></i>
                            </div>
                            <h3 class="feature-title">Easy Collaboration</h3>
                            <p class="feature-description">Work together efficiently with real-time updates</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="container">
            <div class="cta-section">
                <h2 class="cta-title">Ready to Get Started?</h2>
                <p class="cta-subtitle">Join thousands of users who are already staying productive with ReminderApp</p>
                <a href="{{ route('signup') }}" class="btn btn-cta">Create Free Account</a>
            </div>
        </section>
    </div>
@endsection

@push('style')
    <style>
        .hero-section {
            padding: 5rem 0;
            min-height: 85vh;
            display: flex;
            align-items: center;
        }

        .badge-welcome {
            background: var(--light-blue);
            color: var(--primary-blue);
            padding: 0.5rem 1.2rem;
            border-radius: 20px;
            font-weight: 500;
            display: inline-block;
            margin-bottom: 1.5rem;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 1.5rem;
        }

        .hero-subtitle {
            font-size: 1.15rem;
            color: var(--text-gray);
            margin-bottom: 2rem;
            line-height: 1.7;
        }

        .btn-get-started {
            background: var(--primary-blue);
            color: white;
            padding: 0.8rem 2rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            border: none;
        }

        .btn-get-started:hover {
            background: #1d4ed8;
            color: white;
        }

        .btn-learn-more {
            background: transparent;
            color: var(--dark-gray);
            padding: 0.8rem 2rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            margin-left: 1rem;
        }

        .btn-learn-more:hover {
            color: var(--primary-blue);
        }

        .hero-image-wrapper {
            background: linear-gradient(135deg, #e0f2fe 0%, #bfdbfe 100%);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        .hero-image {
            width: 100%;
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        }

        .features-section {
            padding: 5rem 0;
            background: #f9fafb;
        }

        .section-title {
            text-align: center;
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .section-subtitle {
            text-align: center;
            color: var(--text-gray);
            font-size: 1.1rem;
            margin-bottom: 4rem;
        }

        .feature-card {
            background: white;
            border-radius: 15px;
            padding: 2.5rem 2rem;
            border: 1px solid #e5e7eb;
            height: 100%;
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: var(--light-blue);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            font-size: 1.8rem;
            color: var(--primary-blue);
        }

        .feature-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .feature-description {
            color: var(--text-gray);
            line-height: 1.6;
            margin-bottom: 0;
        }

        .cta-section {
            background: var(--primary-blue);
            padding: 4rem 2rem;
            border-radius: 20px;
            margin: 4rem auto;
            max-width: 1200px;
            text-align: center;
        }

        .cta-title {
            color: white;
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .cta-subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.1rem;
            margin-bottom: 2rem;
        }

        .btn-cta {
            background: white;
            color: var(--primary-blue);
            padding: 0.8rem 2.5rem;
            border-radius: 8px;
            font-weight: 600;
            border: none;
        }

        .btn-cta:hover {
            background: #f3f4f6;
            color: var(--primary-blue);
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1rem;
            }

            .btn-learn-more {
                margin-left: 0;
                margin-top: 0.5rem;
            }

            .hero-section {
                padding: 3rem 0;
                min-height: auto;
            }

            .hero-image-wrapper {
                margin-top: 3rem;
            }

            .section-title {
                font-size: 1.5rem;
            }

            .section-subtitle {
                font-size: 1rem;
            }
        }
    </style>
@endpush
