@section('title', 'Recommendation Weights')
@include('../layouts/homeHeader')

<section id="events" class="p-3 pb-5">
    <style>
        /* General container styling */
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        /* Section Title */
        .container h2 {
            font-size: 1.8rem;
            font-weight: bold;
            color: #343a40;
            text-align: center;
            margin-bottom: 20px;
        }
        
        /* Form labels */
        .form-label {
            font-size: 1rem;
            font-weight: 600;
            color: #495057;
        }
        
        /* Form inputs and selects */
        .form-control {
            height: 45px;
            font-size: 1rem;
            color: #495057;
            background-color: #ffffff;
            border: 1px solid #ced4da;
            border-radius: 5px;
            box-shadow: none;
            transition: border-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }
        
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
        }
        
        /* Row styling */
        .row {
            margin-bottom: 15px;
        }
        
        /* Button styling */
        .btn-primary {
            background-color: #007bff;
            border: none;
            height: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-radius: 5px;
            transition: background-color 0.3s ease-in-out;
            width: 100%;
        }
        
        .btn-primary:hover {
            background-color: #0056b3;
        }
        
        /* Alert messages */
        .alert {
            font-size: 1rem;
            font-weight: 500;
            text-align: center;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        
        /* Spacing adjustments */
        .mt-4 {
            margin-top: 1.5rem !important;
        }
        
        .mb-4 {
            margin-bottom: 1.5rem !important;
        }
        
        /* Responsive design adjustments */
        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }
        
            h2 {
                font-size: 1.5rem;
            }
        
            .form-control {
                font-size: 0.9rem;
            }
        
            .btn-primary {
                font-size: 1rem;
            }
        }
        </style>
    <div class="container mt-4">
        <h2 class="mb-4">Manage Your Recommendation Weights</h2>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('weights.update', $weights->id) }}">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <label for="content_based" class="form-label">Content-Based</label>
                    <select class="form-control" id="content_based" name="content_based">
                        @foreach(range(0.1, 0.9, 0.1) as $value)
                            <option value="{{ $value }}" 
                                {{ old('content_based', $weights->content_based) == $value ? 'selected' : '' }}>
                                {{ number_format($value, 1) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="collaborative" class="form-label">Collaborative</label>
                    <select class="form-control" id="collaborative" name="collaborative">
                        @foreach(range(0.1, 0.9, 0.1) as $value)
                            <option value="{{ $value }}" 
                                {{ old('collaborative', $weights->collaborative) == $value ? 'selected' : '' }}>
                                {{ number_format($value, 1) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-6">
                    <label for="collaborative_likes" class="form-label">Collaborative Likes</label>
                    <select class="form-control" id="collaborative_likes" name="collaborative_likes">
                        @foreach(range(0.1, 0.9, 0.1) as $value)
                            <option value="{{ $value }}" 
                                {{ old('collaborative_likes', $weights->collaborative_likes) == $value ? 'selected' : '' }}>
                                {{ number_format($value, 1) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="demographic" class="form-label">Demographic</label>
                    <select class="form-control" id="demographic" name="demographic">
                        @foreach(range(0.1, 0.9, 0.1) as $value)
                            <option value="{{ $value }}" 
                                {{ old('demographic', $weights->demographic) == $value ? 'selected' : '' }}>
                                {{ number_format($value, 1) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-4">Update Weights</button>
        </form>
    </div>
</section>

@include('../layouts/homefooter')
