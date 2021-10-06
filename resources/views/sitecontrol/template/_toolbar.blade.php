
<div class="toolbar py-5 py-lg-15" id="kt_toolbar">
    
    <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">
        
        <div class="page-title d-flex flex-column me-3">
        
            @if ( $breadcrumbs_list !== FALSE )

                @if (array_key_exists("page_title", $breadcrumbs_list))
                    <h1 class="d-flex text-white fw-bolder my-1 fs-3">{{ $breadcrumbs_list["page_title"] }}</h1>
                @endif
                

                @if (array_key_exists("links_list", $breadcrumbs_list))

                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                
                    @php
                        $breadcrumb_index = 0
                    @endphp

                    @foreach ($breadcrumbs_list["links_list"] as $single_breadcrumb)
                        
                        @php $breadcrumb_index++ @endphp

                        @if ( array_key_exists("url", $single_breadcrumb))

                            <li class="breadcrumb-item text-white opacity-75">
                                <a href="{{ $single_breadcrumb['url'] }}" class="text-white text-hover-primary">{{ $single_breadcrumb["name"] }}</a>
                            </li>

                            
                            
                        @else 
                            <li class="breadcrumb-item text-white opacity-75">{{ $single_breadcrumb["name"] }}</li>
                
                        @endif


                        @if ( $breadcrumb_index < count($breadcrumbs_list["links_list"]) )

                            <li class="breadcrumb-item">
                                <span class="bullet bg-white opacity-75 w-5px h-2px"></span>
                            </li>
                        @endif
                        
                    @endforeach
                    
                    
                </ul>
                @endif

            @endif
            
        </div>
        


        
        <!-- <div class="d-flex align-items-center py-3 py-md-1">
            
            <div class="me-4">
                
                <a href="#"
                    class="btn btn-custom btn-active-white btn-flex btn-color-white btn-active-color-primary fw-bolder"
                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                    
                    <span class="svg-icon svg-icon-5 svg-icon-gray-500 me-1">
                        <svg xmlns="http://www.w3.org/2000.svg') }}" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z"
                                fill="black" />
                        </svg>
                    </span>
                    Filter
                </a>
                
                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true"
                    id="kt_menu_613229efe626e">
                    
                    <div class="px-7 py-5">
                        <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                    </div>
                    
                    
                    <div class="separator border-gray-200"></div>
                    
                    
                    <div class="px-7 py-5">
                        
                        <div class="mb-10">
                            
                            <label class="form-label fw-bold">Status:</label>
                            
                            
                            <div>
                                <select class="form-select form-select-solid" data-kt-select2="true"
                                    data-placeholder="Select option" data-dropdown-parent="#kt_menu_613229efe626e"
                                    data-allow-clear="true">
                                    <option></option>
                                    <option value="1">Approved</option>
                                    <option value="2">Pending</option>
                                    <option value="2">In Process</option>
                                    <option value="2">Rejected</option>
                                </select>
                            </div>
                            
                        </div>
                        
                        
                        <div class="mb-10">
                            
                            <label class="form-label fw-bold">Member Type:</label>
                            
                            
                            <div class="d-flex">
                                
                                <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                    <input class="form-check-input" type="checkbox" value="1" />
                                    <span class="form-check-label">Author</span>
                                </label>
                                
                                
                                <label class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="2" checked="checked" />
                                    <span class="form-check-label">Customer</span>
                                </label>
                                
                            </div>
                            
                        </div>
                        
                        
                        <div class="mb-10">
                            
                            <label class="form-label fw-bold">Notifications:</label>
                            
                            
                            <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value="" name="notifications"
                                    checked="checked" />
                                <label class="form-check-label">Enabled</label>
                            </div>
                            
                        </div>
                        
                        
                        <div class="d-flex justify-content-end">
                            <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2"
                                data-kt-menu-dismiss="true">Reset</button>
                            <button type="submit" class="btn btn-sm btn-primary"
                                data-kt-menu-dismiss="true">Apply</button>
                        </div>
                        
                    </div>
                    
                </div>
                
                
            </div>
            
            
            <a href="#" class="btn btn-bg-white btn-active-color-primary" data-bs-toggle="modal"
                data-bs-target="#kt_modal_create_app" id="kt_toolbar_primary_button">Create</a>
            
        </div> -->
        

        
    </div>
    
</div>
