<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="colorlib.com">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $pf_wizard?->title }}</title>

    <!-- Font Icon -->
    <link rel="stylesheet"
        href="{{ asset('vendor/productfinder/fonts/material-icon/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/productfinder/lib/nouislider/nouislider.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Main css -->
    <link rel="stylesheet" href="{{ asset('vendor/productfinder/css/style.css') }}">
    <style>
        .upload-container {
          display: flex;
          flex-wrap: wrap;
          justify-content: space-between;
          padding-bottom: 20px;
          border-bottom: #ccc 1px solid;
          margin-bottom: 20px;

        }
        
        .image-button {
          display: flex;
          flex-direction: column;
          align-items: center;
          justify-content: center;
          background-color: #fff;
          border: 1px solid #ccc;
          padding: 10px;
          width: calc(20% - 10px);
          margin-bottom: 10px;
          border-radius: 8px;
          box-shadow: 0px 0px 5px
        }
        
        .image-button img {
          max-width: 100%;
          margin-bottom: 5px;
        }
        
        /* Responsive styles */
        @media (max-width: 768px) {
          .upload-container {
            flex-direction: column;
            align-items: center;
          }
          
          .image-button {
            width: 100%;
            margin-right: 0;
            margin-bottom: 20px;
          }
        
          .image-button:last-child {
            margin-bottom: 0;
          }
          
          .image-button input[type="file"] {
            margin-top: 5px;
          }
        }
        .title-section{
            font-weight: 900;
            font-size: 17px;
            margin: 10px 1px;
        }
        </style>
        
</head>

<body>
    @isset($pf_wizard)
        <div class="main">
            @php
                $conditions = [];
                $answers = [];
            @endphp
            <div class="container">
                <form method="POST" id="signup-form" class="signup-form" action="#">
                    <div>
                        <h3> Hair conditions</h3>
                        <fieldset>
                            <h3>Find the best Service for you!</h3>
                           
                            <div class="fieldset-content">
                                <div class="choose-bank">
                                    <span class="title-section">Upload Your images:</span>
                                    <p class="desc">Please describe your hair condition to proceed to the next step.
                                    </p>
                                    <div class="upload-container">
                                        <label for="front-image" class="image-button">
                                          <img src="{{ asset('vendor/productfinder/images/4.jpg') }}" alt="Front View">
                                          Upload Front View
                                          <input type="file" id="front-image" name="front-image[]" accept="image/*" multiple>
                                        </label>
                                      
                                        <label for="top-image" class="image-button">
                                          <img src="{{ asset('vendor/productfinder/images/1.jpg') }}" alt="Top View">
                                          Upload Top View
                                          <input type="file" id="top-image" name="top-image[]" accept="image/*" multiple>
                                        </label>
                                      
                                        <label for="left-image" class="image-button">
                                          <img src="{{ asset('vendor/productfinder/images/3.jpg') }}" alt="Right View">
                                          Upload Right View
                                          <input type="file" id="right-image" name="left-image[]" accept="image/*" multiple>
                                        </label>
                                      
                                        <label for="left-image" class="image-button">
                                          <img src="{{ asset('vendor/productfinder/images/2.jpg') }}" alt="Left View">
                                          Upload Left View
                                          <input type="file" id="left-image" name="left-image[]" accept="image/*" multiple>
                                        </label>
                                      </div>
            

                                      <span class="title-section">Choose the closest condition:</span>
                                      <p class="desc">Please choose the closest option from the list of hair conditions to proceed to the next step.
                                      </p>
                                  
                                  
                                      <div class="form-radio-flex">
                                        <div class="form-radio-item">
                                            <input type="radio" name="choose_bank" id="bank_1" value="bank_1"
                                                checked="checked" />
                                            <label for="bank_1"><img
                                                    src="{{ asset('vendor/productfinder/images/11.jpg') }}"
                                                    alt=""></label>
                                        </div>

                                        <div class="form-radio-item">
                                            <input type="radio" name="choose_bank" id="bank_2" value="bank_2" />
                                            <label for="bank_2"><img
                                                    src="{{ asset('vendor/productfinder/images/12.jpg') }}"
                                                    alt=""></label>
                                        </div>

                                        <div class="form-radio-item">
                                            <input type="radio" name="choose_bank" id="bank_3" value="bank_3" />
                                            <label for="bank_3"><img
                                                    src="{{ asset('vendor/productfinder/images/13.jpg') }}"
                                                    alt=""></label>
                                        </div>

                                        <div class="form-radio-item">
                                            <input type="radio" name="choose_bank" id="bank_4" value="bank_4" />
                                            <label for="bank_4"><img
                                                    src="{{ asset('vendor/productfinder/images/14.jpg') }}"
                                                    alt=""></label>
                                        </div>

                                        <div class="form-radio-item">
                                            <input type="radio" name="choose_bank" id="bank_5" value="bank_5" />
                                            <label for="bank_5"><img
                                                    src="{{ asset('vendor/productfinder/images/15.jpg') }}"
                                                    alt=""></label>
                                        </div>

                                        <div class="form-radio-item">
                                            <input type="radio" name="choose_bank" id="bank_6" value="bank_6" />
                                            <label for="bank_6"><img
                                                    src="{{ asset('vendor/productfinder/images/16.jpg') }}"
                                                    alt=""></label>
                                        </div>

                                        <div class="form-radio-item">
                                            <input type="radio" name="choose_bank" id="bank_7" value="bank_7" />
                                            <label for="bank_7"><img
                                                    src="{{ asset('vendor/productfinder/images/17.jpg') }}"
                                                    alt=""></label>
                                        </div>

                                        <div class="form-radio-item">
                                            <input type="radio" name="choose_bank" id="bank_8" value="bank_8" />
                                            <label for="bank_8"><img
                                                    src="{{ asset('vendor/productfinder/images/11.jpg') }}"
                                                    alt=""></label>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </fieldset>
                        @foreach ($pf_steps as $pf_step)
                            <h3>{{ $pf_step->title }}</h3>
                            <fieldset>
                                <h2>{{ $pf_step->title }}</h2>
                                <p class="desc">{{ $pf_step->desc }}</p>
                                <div class="fieldset-content">

                                    @foreach ($pf_step->questions as $pf_question)
                                        @php
                                            $conditions[] = [
                                                $pf_question->id => $pf_question->conditions,
                                            ];
                                            
                                        @endphp
                                        <div class="form-row">
                                            <h4>{{ $pf_question->title }}<span
                                                    class="{{ $pf_question->is_required ? 'required' : '' }}">{{ $pf_question->is_required ? ' * ' : '' }}</span>
                                            </h4>
                                            @if ($pf_question->typeOption?->type?->name === 'checkbox')
                                                @foreach ($pf_question->options as $value => $label)
                                                    @php
                                                    $option_value = json_decode($option->value);
                                                    @endphp
                                                    <label>
                                                        <input type="checkbox" name="{{ $pf_question->id }}[]"
                                                            value="{{ $option->id }} {{ $pf_question->is_required ? 'required' : '' }}">
                                                        <span class="radio-text">{{ $option_value->title }}</span>
                                                    </label>
                                                    @endforeach
                                            @endif

                                            @if ($pf_question->typeOption?->type?->name === 'radio')
                                                @foreach ($pf_question->options as $option)
                                                    @php
                                                        $option_value = json_decode($option->value);
                                                        $typeOption =json_decode($pf_question->typeOption->option);
                                                        
                                                    @endphp
                                                    @if($typeOption->radio->theme=='btn')
                                                    <div class="action">
                                                        <input type="radio" id="option{{ $option->id }}" name="{{ $pf_question->id }}"
                                                            value="{{ $option->id }}" >
                                                        <label class="option{{ $option->id }}">{{ $option_value->title }}</label>
                                                    
                                                    </div>
                                                    @else
                                                    <label>
                                                        <input type="radio" name="{{ $pf_question->id }}"
                                                            value="{{ $option->id }}" {{ $pf_question->is_required ? 'required' : '' }}>
                                                        <span class="radio-text">{{ $option_value->title }}</span>
                                                    </label>    
                                                    @endif
                                                @endforeach
                                            @endif
                                            @if ($pf_question->typeOption?->type?->name === 'range')
                                            @foreach ($pf_question->options as $option)
                                                    @php
                                                        $option_value = json_decode($option->value);
                                                        $typeOption =json_decode($pf_question->typeOption->option);
                                                        
                                                    @endphp
                                                     <div class="form-group">
                                                        <div class="donate-us">
                                                            <div class="price_slider ui-slider ui-slider-horizontal">
                                                                <div id="slider-margin"></div>
                                                                <p class="your-money">
                                                                    My budget is:
                                                                    <span class="money" id="value-lower"></span>
                                                                    <span class="money" id="value-upper"></span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <p class="desc">Please use the slider to indicate your budget for hair restoration procedures.</p>
                                                    </div>
                                                @endforeach
                                               
                                            @endif
                                            @if ($pf_question->typeOption?->type?->name === 'input')
                                                @foreach ($pf_question->options as $option)
                                                @php
                                                    $option_value = json_decode($option->value);
                                                    $typeOption =json_decode($pf_question->typeOption->option);
                                                @endphp
                                                @if($typeOption->input->theme=='textarea')
                                                
                                                <label>
                                                    <textarea  id="option{{ $option->id }}" name="{{ $pf_question->id }}"
                                                        value="" cols="{{$typeOption->input->cols}}" rows="{{$typeOption->input->total_line}}" ></textarea>
                                                    </label>
                                                

                                                
                                                @elseif($typeOption->input->theme=='price')
                                                    <label >
                                                    <input type="number" name="{{ $pf_question->id }}" min="{{$typeOption->input->min}}" max="{{$typeOption->input->max}}"
                                                        value="" {{ $pf_question->is_required ? 'required' : '' }}>
                                                    </label>
                                                @else
                                                <label >
                                                <input type="text" id="option{{ $option->id }}" name="{{ $pf_question->id }}"
                                                    value="" rows="{{$typeOption->input->total_line}}">
                                                </label>
                                                @endif
                                                @endforeach
                                            @endif

                                            <p class="desc">{{ $pf_question->desc }}</p>
                                        </div>
                                    @endforeach


                                </div>
                            </fieldset>
                        @endforeach
        
                        <h3>Best Service for you!</h3>
                        <fieldset>
                            <h3>Find the best product for you!</h3>
                            <p class="desc">Please enter your infomation and proceed to next step so we can build your
                                account</p>
                            <div class="fieldset-content">
                                <div class="choose-bank">
                                    <h2>Best Service for you!</h2>
                                    <div class="card">
                                        <div class="card__title">
                                            <div class="icon">
                                                <a href="#"><i class="fa fa-info-circle"></i> Service #1</a>
                                            </div>
                                            <h3>New products</h3>
                                        </div>

                                        <div class="card__body">
                                            <div class="half">
                                                <div class="featured_text">
                                                    <h1>Nurton</h1>
                                                    <div>
                                                        <p class="price">$210.00</p>
                                                    </div>
                                                </div>
                                                <div class="image">
                                                    <img src="https://images-na.ssl-images-amazon.com/images/I/613A7vcgJ4L._SL1500_.jpg"
                                                        alt="">
                                                </div>
                                            </div>
                                            <div class="half">
                                                <div class="description">
                                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero
                                                        voluptatem nam pariatur voluptate perferendis, asperiores
                                                        aspernatur! Porro similique consequatur, nobis soluta minima,
                                                        quasi laboriosam hic cupiditate perferendis esse numquam magni.
                                                    </p>
                                                </div>
                                                <span class="stock"><i class="fa fa-pen"></i> In stock</span>
                                                <div class="reviews">
                                                    <ul class="stars">
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star-o"></i></li>
                                                    </ul>
                                                    <span>(sample text!)</span>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="card__footer">
                                            <div class="action">
                                                <input type="radio" id="option1" name="options">
                                                <label for="option1">Option 1</label>
                                              </div>
                                            
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card__title">
                                            <div class="icon">
                                                <a href="#"><i class="fa fa-info-circle"></i> Serive #2</a>
                                            </div>
                                            <h3>New products</h3>
                                        </div>

                                        <div class="card__body">
                                            <div class="half">
                                                <div class="featured_text">
                                                    <h1>Nurton</h1>
                                                    <div>
                                                        <p class="price">$210.00</p>
                                                    </div>
                                                </div>
                                                <div class="image">
                                                    <img src="https://images-na.ssl-images-amazon.com/images/I/613A7vcgJ4L._SL1500_.jpg"
                                                        alt="">
                                                </div>
                                            </div>
                                            <div class="half">
                                                <div class="description">
                                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero
                                                        voluptatem nam pariatur voluptate perferendis, asperiores
                                                        aspernatur! Porro similique consequatur, nobis soluta minima,
                                                        quasi laboriosam hic cupiditate perferendis esse numquam magni.
                                                    </p>
                                                </div>
                                                <span class="stock"><i class="fa fa-pen"></i> In stock</span>
                                                <div class="reviews">
                                                    <ul class="stars">
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star-o"></i></li>
                                                    </ul>
                                                    <span>(sample text!)</span>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="card__footer">
                                            <div class="action">
                                                <input type="radio" id="option2" name="options">
                                                <label for="option2">Option 2</label>
                                              </div>
                                            
                                        </div>
                                    </div>
                     
                                </div>


                            </div>
                        </fieldset>
                        <h3>Your Information</h3>
                        <fieldset>
                            <h3>Your Information</h3>
                            <p class="desc">"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur,
                                adipisci velit..."
                            </p>
                            <div class="fieldset-content">
                                <div class="form-row">
                                    <label class="form-label">Name</label>
                                    <div class="form-flex">
                                        <div class="form-group">
                                            <input type="text" name="first_name" id="first_name" />
                                            <span class="text-input">First</span>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="last_name" id="last_name" />
                                            <span class="text-input">Last</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" id="email" />
                                    <span class="text-input">Example :<span> Jeff@gmail.com</span></span>
                                </div>
                                <div class="form-group">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" name="phone" id="phone" />
                                </div>
                                <div class="form-date">
                                    <label for="birth_date" class="form-label">Birth Date</label>
                                    <div class="form-date-group">
                                        <div class="form-date-item">
                                            <select id="birth_month" name="birth_month"></select>
                                            <span class="text-input">MM</span>
                                        </div>
                                        <div class="form-date-item">
                                            <select id="birth_date" name="birth_date"></select>
                                            <span class="text-input">DD</span>
                                        </div>
                                        <div class="form-date-item">
                                            <select id="birth_year" name="birth_year"></select>
                                            <span class="text-input">YYYY</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </fieldset>

                    </div>
                </form>
            </div>

        </div>
    @endisset
    <!-- JS -->
    <script src="{{ asset('vendor/productfinder/lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/productfinder/lib/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('vendor/productfinder/lib/jquery-validation/dist/additional-methods.min.js') }}"></script>
    <script src="{{ asset('vendor/productfinder/lib/jquery-steps/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('vendor/productfinder/lib/minimalist-picker/dobpicker.js') }}"></script>
    <script src="{{ asset('vendor/productfinder/lib/nouislider/nouislider.min.js') }}"></script>
    <script src="{{ asset('vendor/productfinder/lib/wnumb/wNumb.js') }}"></script>
    <script src="{{ asset('vendor/productfinder/js/main.js') }}"></script>
</body>

</html>
