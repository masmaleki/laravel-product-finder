<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="colorlib.com">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $pf_wizard?->title }}</title>

    <link rel='stylesheet' href="{{asset('vendor/productfinder/css/normalize.min.css')}}"/>





<link rel="stylesheet"
        href="{{ asset('vendor/productfinder/fonts/material-icon/css/material-design-iconic-font.min.css') }}">
        <link href="https://fonts.googleapis.com/css?family=Hind&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('vendor/productfinder/lib/nouislider/nouislider.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Main css -->



    <link rel='stylesheet' id='fusion-dynamic-css-css' href="{{ asset('vendor/productfinder/css/fusion-styles.min .css') }}" type='text/css' media='all' />
    <link rel='stylesheet' id='font-awesome-css' href='https://www.p-health.at/wp-content/plugins/popup-anything-on-click-pro/assets/css/font-awesome.min.css?ver=2.3' type='text/css' media='all' />

    <link rel="stylesheet" href="{{ asset('vendor/productfinder/css/style.css') }}">

<script>



</script>


</head>

<body>
    <div class="pf-header">
<div class="container ">
    <header class="">
    <img class="pf-menu-logo" width="95" src="https://www.p-health.at/wp-content/uploads/2021/09/Logo-P-Health-Zentrum-fuer-Schoenheit-141.png" >

    <!-- (B) STICKY MENU -->
    <nav class="pf-menu awb-menu awb-menu_row awb-menu_em-hover mobile-mode-collapse-to-button awb-menu_icons-left awb-menu_dc-yes mobile-trigger-fullwidth-off awb-menu_mobile-toggle awb-menu_indent-center mobile-size-full-absolute awb-menu_desktop awb-menu_dropdown awb-menu_expand-left awb-menu_transition-fade" style="position:sticky; top:0; left:0;">
    <a  href="URL">Home</a>
    <a class="pf-menu-acitve" href="URL">Product finder</a>
    <a href="#">NEWS</a>
    <a href="#">KONTAKT</a>
    </nav>
    </header>

    </div>
    </div>
     <main id="main">
    @isset($pf_wizard)
        <div class="main">
            @php
                $AndConditions = [];
                $OrConditions = [];
                $answers = [];
            @endphp
            <div class="container">
                <form method="POST" id="signup-form" class="signup-form" action="#">
                    <div>

                        @foreach ($pf_steps as $pf_step)
                            <h3>{{ $pf_step->title }}</h3>
                            <fieldset>
                                <h2>{{ $pf_step->title }}</h2>
                                @if(!empty($pf_step->desc) )
                                <p class="desc q-desc">
                                    <span class="desc-highlight"><i class="fa fa-info-circle" aria-hidden="true"></i>
                                        {{ $pf_step->desc }}</span>
                                  </p>
                                @endif
                                
                                <div class="fieldset-content">

                                    @foreach ($pf_step->questions as $pf_question)
                                        @php
                                            //start conditions
                                            $check_conditions=json_decode($pf_question->conditions);
                                            //check_conditions_flag&check_conditions_hidden for check question defualt hidden
                                            $check_conditions_flag=(empty($check_conditions->and_conditions) and empty($check_conditions->or_conditions)) ? true:false;
                                            $check_conditions_hidden=($check_conditions_flag==false) ? 'hidden':'';
                                            //if question have some condition prepare varable to check js
                                            if(!$check_conditions_flag){
                                                //prepare and_conditions
                                                foreach ($check_conditions->and_conditions as $kay =>$value) {
                                                    if(array_key_exists($kay,$AndConditions)){
                                                        $AndConditions[$kay] = 
                                                             [$AndConditions[$kay],[$value,$pf_question->id]]
                                                        ;
                                                    }
                                                    else{
                                                        $AndConditions[$kay] = [$value,$pf_question->id];
                                                    }
                                                }
                                                //prepare or_conditions
                                                foreach ($check_conditions->or_conditions as $kay =>$value) {
                                                    
                                                    if(array_key_exists($kay,$OrConditions)){
                                                        $OrConditions[$kay] = 
                                                             [$OrConditions[$kay],[$value,$pf_question->id]]
                                                        ;
                                                    }
                                                    else{
                                                        $OrConditions[$kay] = [$value,$pf_question->id];
                                                    }
                                                }
                                            }
                                        @endphp
                                        <div id="PFQ_{{$pf_question->id}}" class="form-row {{$check_conditions_hidden}}">
                                            <h4>{{ $pf_question->title }}<span
                                                    class="{{ $pf_question->is_required ? 'required' : '' }}">{{ $pf_question->is_required ? ' * ' : '' }}</span>
                                            </h4>
                                            @if ($pf_question->typeOption?->type?->name === 'checkbox')
                                                <div class="checkbox-options">
                                                    @foreach ($pf_question->options as $option)
                                                        @php
                                                            $option_value = json_decode($option->value);
                                                        @endphp
                                                        <label>
                                                            <input type="checkbox"  name="{{ $pf_question->id }}[]" onclick="checkConditions(this);"
                                                                value="{{ $option->id }}" class="custom-checkbox" >
                                                            <span class="checkbox-text">{{ $option_value->title }}</span>
                                                        </label>
                                                    @endforeach
                                                </div>
                                            
                                            @endif

                                            @if ($pf_question->typeOption?->type?->name === 'radio')
                                                @foreach ($pf_question->options as $option)
                                                    @php
                                                        $option_value = json_decode($option->value);
                                                        $typeOption = json_decode($pf_question->typeOption->option);
                                                        $input_id = 'option' . $pf_question->id . '_' . $option->id;
                                                    @endphp
                                                    @if ($typeOption->radio->theme == 'btn')
                                                        <div class="action">
                                                            <input type="radio" onclick="checkConditions(this);" id="{{ $input_id }}"
                                                                name="{{ $pf_question->id }}" value="{{ $option->id }}">
                                                            <label for="{{ $input_id }}" id="option{{ $option->id }}"
                                                                class="btn">{{ $option_value->title }}</label>
                                                        </div>
                                                    @else
                                                        <label>
                                                            <input type="radio" id="{{ $input_id }}" onclick="checkConditions(this);"
                                                                name="{{ $pf_question->id }}" value="{{ $option->id }}"
                                                                {{ $pf_question->is_required ? 'required' : '' }}>
                                                            <span class="radio-text">{{ $option_value->title }}</span>
                                                        </label>
                                                    @endif
                                                @endforeach
                                            @endif

                                            @if ($pf_question->typeOption?->type?->name === 'range')
                                                @foreach ($pf_question->options as $option)
                                                    @php
                                                        $option_value = json_decode($option->value);
                                                        $typeOption = json_decode($pf_question->typeOption->option);
                                                        
                                                    @endphp
                                                    
                                                    <div class="range-wrap" style="width: 85%;">
                                                        <input id="myRange" name="{{ $pf_question->id }}" type="range" class="range"
                                                         min="{{$typeOption->range->min}}" max="{{$typeOption->range->max}}" 
                                                         value="{{$typeOption->range->def_value}}" step="{{$typeOption->range->step}}">
                                                        <output class="bubble">
                                                            <span>{{$typeOption->range->unit}}</span><input type="number" id="rangeValue" value="{{$typeOption->range->def_value}}">
                                                        </output>
                                                    </div>
                                                @endforeach
                                            @endif
                                            @if ($pf_question->typeOption?->type?->name === 'input')
                                                @foreach ($pf_question->options as $option)
                                                    @php
                                                        $option_value = json_decode($option->value);
                                                        $typeOption = json_decode($pf_question->typeOption->option);
                                                    @endphp
                                                    @if ($typeOption->input->theme == 'textarea')
                                                        <label>
                                                        <textarea id="option{{ $option->id }}" name="{{ $pf_question->id }}" value=""
                                                          cols="{{ $typeOption->input->cols }}" rows="{{ $typeOption->input->total_line }}"
                                                          class="pf-textarea"></textarea>
                                                      </label>
                                                    @elseif($typeOption->input->theme == 'price')
                                                    <label>
                                                        <input type="number" name="{{ $pf_question->id }}" min="{{ $typeOption->input->min }}" max="{{ $typeOption->input->max }}" value=""
                                                          placeholder="Enter only numbers" class="pf-number-input">
                                                      </label>
                                                      
                                                    @else
                                                    <label>
                                                        <input type="text" id="option{{ $option->id }}" name="{{ $pf_question->id }}" value=""
                                                          rows="{{ $typeOption->input->total_line }}" placeholder="Enter your answer here" class="pf-text-input">
                                                      </label>
                                                    @endif
                                                @endforeach
                                            @endif
                                            @if(!empty($pf_question->desc) )
                                            <p class="desc q-desc">
                                                <span class="desc-highlight"><i class="fa fa-info-circle" aria-hidden="true"></i>
                                                    {{ $pf_question->desc }}</span>
                                            </p>
                                            @endif

                                        </div>
                                    @endforeach


                                </div>
                            </fieldset>
                        @endforeach
                @php
                $AndConditions = json_encode($AndConditions);
                $OrConditions= json_encode($OrConditions);
            @endphp
                      
                        <h3> Hair conditions</h3>
                        <fieldset>
                            <h3>Find the best Service for you!</h3>

                            <div class="fieldset-content">
                                <div class="choose-bank">
                                    <span class="title-section">Upload Your images:</span>
                                    <p class="desc-ch">
                                            Please describe your hair condition to proceed to the next step.
                                    </p>
                                    <div class="upload-container">
                                        <label for="front-image" class="image-button">
                                            <img src="{{ asset('vendor/productfinder/images/4.jpg') }}" alt="Front View">
                                            Upload Front View
                                            <input type="file" id="front-image" name="front-image[]" accept="image/*"
                                                multiple>
                                        </label>

                                        <label for="top-image" class="image-button">
                                            <img src="{{ asset('vendor/productfinder/images/1.jpg') }}" alt="Top View">
                                            Upload Top View
                                            <input type="file" id="top-image" name="top-image[]" accept="image/*"
                                                multiple>
                                        </label>

                                        <label for="left-image" class="image-button">
                                            <img src="{{ asset('vendor/productfinder/images/3.jpg') }}" alt="Right View">
                                            Upload Right View
                                            <input type="file" id="right-image" name="left-image[]" accept="image/*"
                                                multiple>
                                        </label>

                                        <label for="left-image" class="image-button">
                                            <img src="{{ asset('vendor/productfinder/images/2.jpg') }}" alt="Left View">
                                            Upload Left View
                                            <input type="file" id="left-image" name="left-image[]" accept="image/*"
                                                multiple>
                                        </label>
                                    </div>


                                    <span class="title-section">Choose the closest condition:</span>
                                      <p class="desc-ch">
                                            Please choose the closest option from the list of hair conditions to
                                            proceed to the next step.
                                      </p>
                                    


                                    <div class="form-radio-flex">
                                        <div class="form-radio-item">
                                            <input type="checkbox" name="choose_hair_ai[]" id="bank_1" value="bank_1"
                                                checked="checked" />
                                            <label for="bank_1"><img
                                                    src="{{ asset('vendor/productfinder/images/11.jpg') }}"
                                                    alt=""></label>
                                        </div>

                                        <div class="form-radio-item">
                                            <input type="checkbox" name="choose_hair_ai[]" id="bank_2" value="bank_2" />
                                            <label for="bank_2"><img
                                                    src="{{ asset('vendor/productfinder/images/12.jpg') }}"
                                                    alt=""></label>
                                        </div>

                                        <div class="form-radio-item">
                                            <input type="checkbox" name="choose_hair_ai[]" id="bank_3" value="bank_3" />
                                            <label for="bank_3"><img
                                                    src="{{ asset('vendor/productfinder/images/13.jpg') }}"
                                                    alt=""></label>
                                        </div>

                                        <div class="form-radio-item">
                                            <input type="checkbox" name="choose_hair_ai[]" id="bank_4" value="bank_4" />
                                            <label for="bank_4"><img
                                                    src="{{ asset('vendor/productfinder/images/14.jpg') }}"
                                                    alt=""></label>
                                        </div>

                                        <div class="form-radio-item">
                                            <input type="checkbox" name="choose_hair_ai[]" id="bank_5" value="bank_5" />
                                            <label for="bank_5"><img
                                                    src="{{ asset('vendor/productfinder/images/15.jpg') }}"
                                                    alt=""></label>
                                        </div>

                                        <div class="form-radio-item">
                                            <input type="checkbox" name="choose_hair_ai[]" id="bank_6" value="bank_6" />
                                            <label for="bank_6"><img
                                                    src="{{ asset('vendor/productfinder/images/16.jpg') }}"
                                                    alt=""></label>
                                        </div>

                                        <div class="form-radio-item">
                                            <input type="checkbox" name="choose_hair_ai[]" id="bank_7" value="bank_7" />
                                            <label for="bank_7"><img
                                                    src="{{ asset('vendor/productfinder/images/17.jpg') }}"
                                                    alt=""></label>
                                        </div>

                                        <div class="form-radio-item">
                                            <input type="checkbox" name="choose_hair_ai[]" id="bank_8" value="bank_8" />
                                            <label for="bank_8"><img
                                                    src="{{ asset('vendor/productfinder/images/11.jpg') }}"
                                                    alt=""></label>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </fieldset>
                        <h3>Best Service</h3>
                        <fieldset>
                            <h3>Find the best product for you!</h3>
                            <p class="desc q-desc">
                                <span class="desc-highlight"><i class="fa fa-info-circle" aria-hidden="true"></i>
                                    Please enter your infomation and proceed to next step so we can build your
                                    account
                                </span>
                              </p>
                            <div class="fieldset-content">
                                <div class="choose-bank hidden" id="servicex">
                                    <h2>Best Service for you!</h2>
                       
                                    
                                      <div class="card">
                            
                                        <div class="card__title">
                                            <div class="icon">
                                                <a href="#"> <i class="fa fa-info-circle"></i> Service: "Anti-Hair Loss"</a>
                                            </div>
                                            <h3>New products</h3>
                                        </div>
                                        
                                        <div class="card__body">
                                            <div class="featured_text">
                                                <h1>B {{rand(1,100)}} </h1>
                                            </div>
                                                                                        
                                            <div class="half">
                                                <div class="description">
                                                    <p>This service provides personalized recommendations and treatments to prevent hair loss and promote healthy hair growth. Our team of experts will work with you to create a customized plan based on your unique needs and goals.</p>
                                                </div>
                                                                                        
                                                <span class="stock">
                                                    <div>
                                                        <p class="price">$210.00</p>
                                                    </div>
                                                    Available
                                                </span>
                                                
                                                <div class="reviews">
                                                    <ul class="stars">
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star-o"></i></li>
                                                    </ul>
                                                    <span>(Mostly Positive)</span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="card__footer">
                                            <div class="action">
                                                <input type="radio" id="option1" name="options">
                                                <label for="option1">Select Service</label>
                                            </div>
                                        </div>
                                        
                                    </div>

                                    {{-- for product --}}
                                    {{-- <div class="card">
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
                                    </div> --}}

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
                               
                            </div>
                        </fieldset>
                    </div>
                </form>
            </div>

        </div>
    @endisset
</main>
<div class="fusion-tb-footer fusion-footer"><div class="fusion-footer-widget-area fusion-widget-area"><div class="fusion-fullwidth fullwidth-box fusion-builder-row-19 fusion-flex-container nonhundred-percent-fullwidth non-hundred-percent-height-scrolling" style="--awb-border-radius-top-left:0px;--awb-border-radius-top-right:0px;--awb-border-radius-bottom-right:0px;--awb-border-radius-bottom-left:0px;--awb-padding-top:72px;--awb-padding-bottom:72px;--awb-padding-top-small:24px;--awb-padding-bottom-small:24px;--awb-background-color:#f2f2ed;"><div class="fusion-builder-row fusion-row fusion-flex-align-items-flex-start" style="max-width:1320.8px;margin-left: calc(-4% / 2 );margin-right: calc(-4% / 2 );"><div class="fusion-layout-column fusion_builder_column fusion-builder-column-34 fusion_builder_column_2_5 2_5 fusion-flex-column" style="--awb-padding-top:0px;--awb-bg-size:cover;--awb-width-large:40%;--awb-margin-top-large:0px;--awb-spacing-right-large:4.8%;--awb-spacing-left-large:4.8%;--awb-width-medium:50%;--awb-order-medium:0;--awb-spacing-right-medium:3.84%;--awb-margin-bottom-medium:0px;--awb-spacing-left-medium:3.84%;--awb-width-small:100%;--awb-order-small:0;--awb-spacing-right-small:1.92%;--awb-margin-bottom-small:0px;--awb-spacing-left-small:1.92%;"><div class="fusion-column-wrapper fusion-column-has-shadow fusion-flex-justify-content-flex-start fusion-content-layout-column"><div class="fusion-title title fusion-title-28 fusion-sep-none fusion-title-text fusion-title-size-div" style="--awb-margin-top:0px;--awb-margin-bottom:0px;--awb-font-size:28px;"><div class="title-heading-left title-heading-tag fusion-responsive-typography-calculated" style="font-family:&quot;Playfair Display&quot;;font-style:normal;font-weight:400;margin:0;font-size:1em;--fontSize:28;line-height:1.76;"><p>Zentrum für Gesunde Schönheit<br>
Papp &amp; Papp</p></div></div><div class="fusion-builder-row fusion-builder-row-inner fusion-row fusion-flex-align-items-flex-start" style="width:104% !important;max-width:104% !important;margin-left: calc(-4% / 2 );margin-right: calc(-4% / 2 );"><div class="fusion-layout-column fusion_builder_column_inner fusion-builder-nested-column-9 fusion_builder_column_inner_1_2 1_2 fusion-flex-column" style="--awb-padding-top:0px;--awb-padding-bottom-medium:0px;--awb-padding-bottom-small:0px;--awb-bg-size:cover;--awb-width-large:50%;--awb-margin-top-large:0px;--awb-spacing-right-large:3.84%;--awb-spacing-left-large:3.84%;--awb-width-medium:100%;--awb-order-medium:0;--awb-spacing-right-medium:1.92%;--awb-margin-bottom-medium:0;--awb-spacing-left-medium:1.92%;--awb-width-small:100%;--awb-order-small:0;--awb-spacing-right-small:1.92%;--awb-margin-bottom-small:0;--awb-spacing-left-small:1.92%;"><div class="fusion-column-wrapper fusion-column-has-shadow fusion-flex-justify-content-flex-start fusion-content-layout-column"><div class="fusion-title title fusion-title-29 fusion-sep-none fusion-title-text fusion-title-size-four" style="--awb-margin-bottom:0px;--awb-margin-bottom-small:0px;--awb-font-size:13px;"><h4 class="title-heading-left fusion-responsive-typography-calculated" style="font-family:&quot;Work Sans&quot;;font-style:normal;font-weight:500;margin:0;font-size:1em;letter-spacing:0.05em;--fontSize:13;--minFontSize:13;line-height:1.34;">KONTAKT</h4></div><div class="fusion-text fusion-text-20" style="--awb-text-transform:none;--awb-margin-top:-6px;"><p>Telefon: <span style="color: #475e60;"><a style="color: #475e60;" href="tel://+43662251313">+43 662 2513 13</a><br>
E-Mail: <a style="color: #475e60;" href="mailto:med@drpapp.at">med@drpapp.at</a><br>
</span></p>
</div><div class="fusion-title title fusion-title-30 fusion-sep-none fusion-title-text fusion-title-size-four" style="--awb-margin-bottom:0px;--awb-margin-bottom-small:0px;--awb-font-size:13px;"><h4 class="title-heading-left fusion-responsive-typography-calculated" style="font-family:&quot;Work Sans&quot;;font-style:normal;font-weight:500;margin:0;font-size:1em;letter-spacing:0.05em;--fontSize:13;--minFontSize:13;line-height:1.34;">ADRESSE</h4></div><div class="fusion-text fusion-text-21" style="--awb-text-transform:none;--awb-margin-top:-6px;"><p>F.-W.-Raiffeisenstraße 1b<br>
5061 Elsbethen . Salzburg<br>
Austria</p>
</div></div></div><div class="fusion-layout-column fusion_builder_column_inner fusion-builder-nested-column-10 fusion_builder_column_inner_1_2 1_2 fusion-flex-column" style="--awb-padding-top:0px;--awb-padding-top-medium:0px;--awb-padding-top-small:0px;--awb-bg-size:cover;--awb-width-large:50%;--awb-margin-top-large:0px;--awb-spacing-right-large:3.84%;--awb-spacing-left-large:3.84%;--awb-width-medium:100%;--awb-order-medium:0;--awb-margin-top-medium:0;--awb-spacing-right-medium:1.92%;--awb-spacing-left-medium:1.92%;--awb-width-small:100%;--awb-order-small:0;--awb-spacing-right-small:1.92%;--awb-spacing-left-small:1.92%;"><div class="fusion-column-wrapper fusion-column-has-shadow fusion-flex-justify-content-flex-start fusion-content-layout-column"><div class="fusion-title title fusion-title-31 fusion-sep-none fusion-title-text fusion-title-size-four" style="--awb-margin-bottom:0px;--awb-margin-bottom-small:0px;--awb-font-size:13px;"><h4 class="title-heading-left fusion-responsive-typography-calculated" style="font-family:&quot;Work Sans&quot;;font-style:normal;font-weight:500;margin:0;font-size:1em;letter-spacing:0.05em;--fontSize:13;--minFontSize:13;line-height:1.34;">ÖFFNUNGSZEITEN</h4></div><div class="fusion-text fusion-text-22" style="--awb-text-transform:none;--awb-margin-top:-6px;"><p>Montag bis Donnerstag:<br>
09:00 – 18:00 Uhr</p>
<p>Freitag:<br>
09:00 – 16:00 Uhr</p>
</div></div></div></div></div></div><div class="fusion-layout-column fusion_builder_column fusion-builder-column-35 fusion_builder_column_1_5 1_5 fusion-flex-column" style="--awb-padding-top-medium:0px;--awb-bg-size:cover;--awb-width-large:20%;--awb-spacing-right-large:9.6%;--awb-spacing-left-large:9.6%;--awb-width-medium:50%;--awb-order-medium:0;--awb-margin-top-medium:200px;--awb-spacing-right-medium:3.84%;--awb-spacing-left-medium:3.84%;--awb-width-small:100%;--awb-order-small:0;--awb-margin-top-small:0px;--awb-spacing-right-small:1.92%;--awb-spacing-left-small:1.92%;"><div class="fusion-column-wrapper fusion-column-has-shadow fusion-flex-justify-content-flex-start fusion-content-layout-column"><div class="fusion-title title fusion-title-32 fusion-sep-none fusion-title-text fusion-title-size-four" style="--awb-font-size:13px;"><h4 class="title-heading-left fusion-responsive-typography-calculated" style="font-family:&quot;Work Sans&quot;;font-style:normal;font-weight:500;margin:0;font-size:1em;letter-spacing:0.05em;--fontSize:13;--minFontSize:13;line-height:1.34;">INFO &amp; SERVICE</h4></div><nav class="awb-menu awb-menu_column awb-menu_em-hover mobile-mode-collapse-to-button awb-menu_icons-left awb-menu_dc-yes mobile-trigger-fullwidth-off awb-menu_mobile-toggle awb-menu_indent-left mobile-size-full-absolute mega-menu-loading awb-menu_desktop awb-menu_dropdown awb-menu_expand-right awb-menu_transition-fade" style="--awb-font-size:15px;--awb-text-transform:none;--awb-gap:12px;--awb-color:#656a70;--awb-active-color:#181b20;--awb-submenu-color:#656a70;--awb-submenu-active-color:#181b20;--awb-submenu-text-transform:none;--awb-icons-color:#656a70;--awb-icons-hover-color:#181b20;--awb-main-justify-content:flex-start;--awb-mobile-color:#656a70;--awb-mobile-active-color:#181b20;--awb-mobile-justify:flex-start;--awb-mobile-caret-left:auto;--awb-mobile-caret-right:0;--awb-fusion-font-family-typography:inherit;--awb-fusion-font-style-typography:normal;--awb-fusion-font-weight-typography:400;--awb-fusion-font-family-submenu-typography:inherit;--awb-fusion-font-style-submenu-typography:normal;--awb-fusion-font-weight-submenu-typography:400;--awb-fusion-font-family-mobile-typography:inherit;--awb-fusion-font-style-mobile-typography:normal;--awb-fusion-font-weight-mobile-typography:400;" aria-label="Menu" data-breakpoint="0" data-count="2" data-transition-type="fade" data-transition-time="300" aria-expanded="true"><ul id="menu-footer" class="fusion-menu awb-menu__main-ul awb-menu__main-ul_column"><li id="menu-item-5451" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-5451 awb-menu__li awb-menu__main-li awb-menu__main-li_regular" data-item-id="5451"><span class="awb-menu__main-background-default awb-menu__main-background-default_fade"></span><span class="awb-menu__main-background-active awb-menu__main-background-active_fade"></span><a href="https://www.p-health.at/op-zentrum/" class="awb-menu__main-a awb-menu__main-a_regular fusion-flex-link"><span class="awb-menu__i awb-menu__i_main"><i class="fa fa-angle-right" aria-hidden="true"></i></span><span class="menu-text">OP-Zentrum</span></a></li><li id="menu-item-3207" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3207 awb-menu__li awb-menu__main-li awb-menu__main-li_regular" data-item-id="3207"><span class="awb-menu__main-background-default awb-menu__main-background-default_fade"></span><span class="awb-menu__main-background-active awb-menu__main-background-active_fade"></span><a target="_blank" rel="noopener noreferrer" href="https://issuu.com/marketing-deluxe/docs/p-health_-_7_s_ulen_f_r_nachhaltig_gesunde_sch_nhe?fr=sYzI1ZDI0MTgwMTQ" class="awb-menu__main-a awb-menu__main-a_regular fusion-flex-link"><span class="awb-menu__i awb-menu__i_main"><i class="fa fa-angle-right" aria-hidden="true"></i></span><span class="menu-text">Download</span></a></li><li id="menu-item-5416" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-5416 awb-menu__li awb-menu__main-li awb-menu__main-li_regular" data-item-id="5416"><span class="awb-menu__main-background-default awb-menu__main-background-default_fade"></span><span class="awb-menu__main-background-active awb-menu__main-background-active_fade"></span><a href="https://www.p-health.at/pressekontakt/" class="awb-menu__main-a awb-menu__main-a_regular fusion-flex-link"><span class="awb-menu__i awb-menu__i_main"><i class="fa fa-angle-right" aria-hidden="true"></i></span><span class="menu-text">Presse</span></a></li><li id="menu-item-5393" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-5393 awb-menu__li awb-menu__main-li awb-menu__main-li_regular" data-item-id="5393"><span class="awb-menu__main-background-default awb-menu__main-background-default_fade"></span><span class="awb-menu__main-background-active awb-menu__main-background-active_fade"></span><a href="https://www.p-health.at/impressum/" class="awb-menu__main-a awb-menu__main-a_regular fusion-flex-link"><span class="awb-menu__i awb-menu__i_main"><i class="fa fa-angle-right" aria-hidden="true"></i></span><span class="menu-text">Impressum</span></a></li><li id="menu-item-5398" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-privacy-policy menu-item-5398 awb-menu__li awb-menu__main-li awb-menu__main-li_regular" data-item-id="5398"><span class="awb-menu__main-background-default awb-menu__main-background-default_fade"></span><span class="awb-menu__main-background-active awb-menu__main-background-active_fade"></span><a href="https://www.p-health.at/datenschutz/" class="awb-menu__main-a awb-menu__main-a_regular fusion-flex-link"><span class="awb-menu__i awb-menu__i_main"><i class="fa fa-angle-right" aria-hidden="true"></i></span><span class="menu-text">Datenschutz</span></a></li></ul></nav><div class="fusion-title title fusion-title-33 fusion-sep-none fusion-title-text fusion-title-size-four" style="--awb-margin-top:32px;--awb-margin-bottom:8px;--awb-font-size:13px;"><h4 class="title-heading-left fusion-responsive-typography-calculated" style="font-family:&quot;Work Sans&quot;;font-style:normal;font-weight:500;margin:0;font-size:1em;letter-spacing:0.05em;--fontSize:13;--minFontSize:13;line-height:1.34;">OFFENE STELLEN</h4></div></div></div><div class="fusion-layout-column fusion_builder_column fusion-builder-column-36 fusion_builder_column_2_5 2_5 fusion-flex-column" style="--awb-padding-top:30px;--awb-padding-right:30px;--awb-padding-bottom:30px;--awb-padding-left:30px;--awb-overflow:hidden;--awb-bg-color:#779a9e;--awb-bg-size:cover;--awb-border-color:#779a9e;--awb-border-style:solid;--awb-border-radius:30px 0px 30px 0px;--awb-width-large:40%;--awb-spacing-right-large:4.8%;--awb-spacing-left-large:4.8%;--awb-width-medium:100%;--awb-order-medium:0;--awb-spacing-right-medium:1.92%;--awb-spacing-left-medium:1.92%;--awb-width-small:100%;--awb-order-small:0;--awb-spacing-right-small:1.92%;--awb-spacing-left-small:1.92%;"><div class="fusion-column-wrapper fusion-column-has-shadow fusion-flex-justify-content-flex-start fusion-content-layout-column"><div class="fusion-title title fusion-title-34 fusion-sep-none fusion-title-center fusion-title-text fusion-title-size-div" style="--awb-text-color:#ffffff;--awb-margin-bottom:0px;--awb-font-size:28px;"><div class="title-heading-center title-heading-tag fusion-responsive-typography-calculated" style="margin:0;font-size:1em;--fontSize:28;line-height:1.76;">Bleiben Sie informiert!</div></div><div class="fusion-text fusion-text-23 fusion-text-no-margin" style="--awb-content-alignment:center;--awb-text-color:#ffffff;--awb-margin-bottom:20px;"><p>In unserem Newsletter lesen Sie News aus Medizin, Forschung &amp; Entwicklung und unserer Ordination.</p>
</div><div style="text-align:center;"><a class="fusion-button button-flat fusion-button-default-size button-default fusion-button-default button-12 fusion-button-default-span fusion-button-default-type" target="_self" href="#" data-toggle="modal" data-target=".fusion-modal.newsletter"><span class="fusion-button-text">Newsletter abonnieren</span></a></div><div class="fusion-text fusion-text-24 paragraph-small" style="--awb-text-color:#ffffff;--awb-margin-top:10px;"><p style="font-size: 12px; line-height: 24px; text-align: center;" data-fusion-font="true"><span style="color: #ffffff;">* Es gelten die </span><a href="#"><span style="color: #ffffff;">Allgemeinen Datenschutzbestimmungen</span></a></p>
</div></div></div><div class="fusion-layout-column fusion_builder_column fusion-builder-column-37 fusion_builder_column_1_2 1_2 fusion-flex-column" style="--awb-bg-size:cover;--awb-width-large:50%;--awb-margin-top-large:32px;--awb-spacing-right-large:3.84%;--awb-spacing-left-large:3.84%;--awb-width-medium:100%;--awb-order-medium:0;--awb-spacing-right-medium:1.92%;--awb-margin-bottom-medium:0px;--awb-spacing-left-medium:1.92%;--awb-width-small:100%;--awb-order-small:0;--awb-spacing-right-small:1.92%;--awb-spacing-left-small:1.92%;"><div class="fusion-column-wrapper fusion-column-has-shadow fusion-flex-justify-content-flex-start fusion-content-layout-column"><div class="fusion-text fusion-text-25 md-text-align-center sm-text-align-center" style="--awb-font-size:12px;--awb-text-transform:none;"><p>© Copyright 2022 | Zentrum für Gesunde Schönheit in Salzburg</p>
</div></div></div>
<div class="fusion-layout-column fusion_builder_column fusion-builder-column-38 fusion_builder_column_1_2 1_2 fusion-flex-column" style="--awb-bg-size:cover;--awb-width-large:50%;--awb-spacing-right-large:3.84%;--awb-spacing-left-large:3.84%;--awb-width-medium:100%;--awb-order-medium:0;--awb-spacing-right-medium:1.92%;--awb-spacing-left-medium:1.92%;--awb-width-small:100%;--awb-order-small:0;--awb-spacing-right-small:1.92%;--awb-spacing-left-small:1.92%;">
<div class="fusion-column-wrapper fusion-column-has-shadow fusion-flex-justify-content-center fusion-content-layout-column">
<div class="fusion-social-links fusion-social-links-1" style="--awb-margin-top:0px;--awb-margin-right:0px;--awb-margin-bottom:0px;--awb-margin-left:0px;--awb-alignment:right;--awb-box-border-top:0px;--awb-box-border-right:0px;--awb-box-border-bottom:0px;--awb-box-border-left:0px;--awb-icon-colors-hover:rgba(101,106,112,0.8);--awb-box-colors-hover:rgba(255,255,255,0.8);--awb-box-border-color:var(--awb-color3);--awb-box-border-color-hover:var(--awb-color4);--awb-alignment-medium:center;--awb-alignment-small:center;">
<div class="fusion-social-networks color-type-custom">
    <div class="fusion-social-networks-wrapper">
    <i class="fa fa-instagram" aria-hidden="true"></i>
    </a>
    <a class="fusion-social-network-icon fusion-tooltip fusion-facebook awb-icon-facebook" style="color:#181b20;font-size:18px;" data-placement="top" data-title="Facebook" data-toggle="tooltip" title="" aria-label="facebook" target="_blank" rel="noopener noreferrer" href="https://www.facebook.com/DoktorPapp/" data-original-title="Facebook">
</a></div>
</div>
</div>
</div>
</div>
</div>
</div>
</div></div>
    <!-- JS -->
    <script src="{{ asset('vendor/productfinder/lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/productfinder/lib/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('vendor/productfinder/lib/jquery-validation/dist/additional-methods.min.js') }}"></script>
    <script src="{{ asset('vendor/productfinder/lib/jquery-steps/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('vendor/productfinder/lib/minimalist-picker/dobpicker.js') }}"></script>
    <script src="{{ asset('vendor/productfinder/lib/nouislider/nouislider.min.js') }}"></script>
    <script src="{{ asset('vendor/productfinder/lib/wnumb/wNumb.js') }}"></script>
    <script src="{{ asset('vendor/productfinder/js/main.js') }}"></script>
    <script>

    const checkboxes = document.querySelectorAll('input[type="checkbox"]');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            const checkedCheckboxes = document.querySelectorAll('.form-row input[type="checkbox"]:checked');
            
            if (checkedCheckboxes.length >= 2) {
                checkboxes.forEach(c => {
                    if (!c.checked) {
                        c.disabled = true;
                    }
                });
            } else {
                checkboxes.forEach(c => {
                    c.disabled = false;
                });
            }
        });
    });
    function checkConditions(option){
        //TODO check other answer

        let check_conditions_and={!! json_encode($AndConditions) !!};
        check_conditions_and=JSON.parse(check_conditions_and);
        let check_conditions_or={!! json_encode($OrConditions) !!};
        check_conditions_or=JSON.parse(check_conditions_or);
        
        //check condition And
        //TODO fix and becase should check other answer
        if (check_conditions_and[option.name]!=undefined) {
            if(check_conditions_and[option.name][0].includes(parseInt(option.value))){
                $("#PFQ_"+check_conditions_and[option.name][1]).removeClass("hidden");
            }
            else{
                $("#PFQ_"+check_conditions_and[option.name][1]).addClass("hidden");
            }
        }
        //check condition Or
        if (check_conditions_or[option.name]!=undefined) {
            if(check_conditions_or[option.name][0].includes(parseInt(option.value))){
                $("#PFQ_"+check_conditions_or[option.name][1]).removeClass("hidden");
            }
            else{
                $("#PFQ_"+check_conditions_or[option.name][1]).addClass("hidden");
            }
        }
    }
    </script>
</body>

</html>
