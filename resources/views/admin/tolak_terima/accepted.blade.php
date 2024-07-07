@extends('admin.layout')

@section('content')
<div class="flex flex-col w-full py-8 rounded-lg shadow-xl items-center justify-center mb-10">
    <h1 class="text-center text-4xl uppercase font-bold">Accepted</h1>
</div>
<div class="flex flex-col w-full pb-8 rounded-lg shadow-xl items-center justify-center mb-10">
    <!--Tabs navigation-->
    <ul
    class="mb-5 flex list-none flex-row flex-wrap border-b-0 pl-0 w-full"
    role="tablist"
    data-te-nav-ref>
        <li role="presentation" class="flex-auto text-center">
            <a
                href="#InternalDevelopment"
                class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400"
                data-te-toggle="pill"
                data-te-target="#InternalDevelopment"
                data-te-nav-active
                role="tab"
                aria-controls="InternalDevelopment"
                aria-selected="true"
                >Internal Development</a
            >
        </li>
        <li role="presentation" class="flex-auto text-center">
            <a
                href="#CreativenBranding"
                class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400"
                data-te-toggle="pill"
                data-te-target="#CreativenBranding"
                role="tab"
                aria-controls="CreativenBranding"
                aria-selected="false"
                >Creative n Branding</a
            >
        </li>
        <li role="presentation" class="flex-auto text-center">
            <a
                href="#HumanResource"
                class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400"
                data-te-toggle="pill"
                data-te-target="#HumanResource"
                role="tab"
                aria-controls="HumanResource"
                aria-selected="false"
                >Human Resource</a
            >
        </li>
        <li role="presentation" class="flex-auto text-center">
            <a
                href="#ExternalRelationship"
                class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400"
                data-te-toggle="pill"
                data-te-target="#ExternalRelationship"
                role="tab"
                aria-controls="ExternalRelationship"
                aria-selected="false"
                >External Relationship</a
            >
        </li>
        <li role="presentation" class="flex-auto text-center">
            <a
                href="#InformationSystem"
                class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400"
                data-te-toggle="pill"
                data-te-target="#InformationSystem"
                role="tab"
                aria-controls="InformationSystem"
                aria-selected="false"
                >Information System</a
            >
        </li>
        <li role="presentation" class="flex-auto text-center">
            <a
                href="#Academic"
                class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[te-nav-active]:border-primary data-[te-nav-active]:text-primary dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-primary-400 dark:data-[te-nav-active]:text-primary-400"
                data-te-toggle="pill"
                data-te-target="#Academic"
                role="tab"
                aria-controls="Academic"
                aria-selected="false"
                >Academic</a
            >
        </li>
    </ul>

    <!--Tabs content-->
    <div class="mb-2 w-full px-8">
        <div
        class="hidden opacity-100 transition-opacity duration-150 ease-linear data-[te-tab-active]:block"
        id="InternalDevelopment"
        role="tabpanel"
        aria-labelledby="tabs-InternalDevelopment"
        data-te-tab-active>
            <h1 class="text-xl font-bold uppercase mb-1">Divisi Internal Development</h1>
            <hr class="h-[2px] bg-slate-200 dark:bg-gray-600 mb-8 border-none" />
            <div class="px-8 w-full mb-1">
                <div class="relative mb-4 flex w-full flex-wrap items-stretch">
                    <input
                        id="search-InternalDevelopment"
                        type="search"
                        class="relative m-0 -mr-0.5 block w-[1px] min-w-0 flex-auto rounded-l border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:focus:border-primary"
                        placeholder="Search in Internal Development"
                        aria-label="Search"
                        aria-describedby="button-addon1" />
                        
                        <!--Search button-->
                    <button
                        class="relative z-[2] flex items-center rounded-r bg-primary px-6 py-2.5 text-xs font-medium uppercase leading-tight text-white shadow-md transition duration-150 ease-in-out hover:bg-primary-700 hover:shadow-lg focus:bg-primary-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-primary-800 active:shadow-lg"
                        type="button"
                        id="search-InternalDevelopment-button"
                        data-te-ripple-init
                        data-te-ripple-color="light">
                        <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                        class="h-5 w-5">
                        <path
                            fill-rule="evenodd"
                            d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                            clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
            <div id="datatable-InternalDevelopment" class="w-full py-5 rounded-xl"></div>
        </div>
        <div
        class="hidden opacity-0 transition-opacity duration-150 ease-linear data-[te-tab-active]:block"
        id="CreativenBranding"
        role="tabpanel"
        aria-labelledby="tabs-Creative n Branding">
            <h1 class="text-xl font-bold uppercase mb-1">Divisi Creative n Branding</h1>
            <hr class="h-[2px] bg-slate-200 dark:bg-gray-600 mb-8 border-none" />
            <div class="px-8 w-full mb-1">
                <div class="relative mb-4 flex w-full flex-wrap items-stretch">
                    <input
                        id="search-CreativenBranding"
                        type="search"
                        class="relative m-0 -mr-0.5 block w-[1px] min-w-0 flex-auto rounded-l border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:focus:border-primary"
                        placeholder="Search in Creative n Branding"
                        aria-label="Search"
                        aria-describedby="button-addon1" />
                        
                        <!--Search button-->
                    <button
                        class="relative z-[2] flex items-center rounded-r bg-primary px-6 py-2.5 text-xs font-medium uppercase leading-tight text-white shadow-md transition duration-150 ease-in-out hover:bg-primary-700 hover:shadow-lg focus:bg-primary-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-primary-800 active:shadow-lg"
                        type="button"
                        id="search-CreativenBranding-button"
                        data-te-ripple-init
                        data-te-ripple-color="light">
                        <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                        class="h-5 w-5">
                        <path
                            fill-rule="evenodd"
                            d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                            clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
            <div id="datatable-CreativenBranding" class="w-full  py-5 rounded-xl"></div>
        </div>
        <div
        class="hidden opacity-0 transition-opacity duration-150 ease-linear data-[te-tab-active]:block"
        id="HumanResource"
        role="tabpanel"
        aria-labelledby="tabs-HumanResource">
            <h1 class="text-xl font-bold uppercase mb-1">Divisi Human Resource and Development</h1>
            <hr class="h-[2px] bg-slate-200 dark:bg-gray-600 mb-8 border-none" />
            <div class="px-8 w-full mb-1">
                <div class="relative mb-4 flex w-full flex-wrap items-stretch">
                    <input
                        id="search-HumanResource"
                        type="search"
                        class="relative m-0 -mr-0.5 block w-[1px] min-w-0 flex-auto rounded-l border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:focus:border-primary"
                        placeholder="Search in Human Resource and Development"
                        aria-label="Search"
                        aria-describedby="button-addon1" />
                        
                        <!--Search button-->
                    <button
                        class="relative z-[2] flex items-center rounded-r bg-primary px-6 py-2.5 text-xs font-medium uppercase leading-tight text-white shadow-md transition duration-150 ease-in-out hover:bg-primary-700 hover:shadow-lg focus:bg-primary-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-primary-800 active:shadow-lg"
                        type="button"
                        id="search-HumanResource-button"
                        data-te-ripple-init
                        data-te-ripple-color="light">
                        <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                        class="h-5 w-5">
                        <path
                            fill-rule="evenodd"
                            d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                            clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
            <div id="datatable-HumanResource" class="w-full py-5 rounded-xl"></div>
        </div>
        <div
        class="hidden opacity-0 transition-opacity duration-150 ease-linear data-[te-tab-active]:block"
        id="ExternalRelationship"
        role="tabpanel"
        aria-labelledby="tabs-ExternalRelationship">
            <h1 class="text-xl font-bold uppercase mb-1">Divisi External Relationship</h1>
            <hr class="h-[2px] bg-slate-200 dark:bg-gray-600 mb-8 border-none" />
            <div class="px-8 w-full mb-1">
                <div class="relative mb-4 flex w-full flex-wrap items-stretch">
                    <input
                        id="search-ExternalRelationship"
                        type="search"
                        class="relative m-0 -mr-0.5 block w-[1px] min-w-0 flex-auto rounded-l border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:focus:border-primary"
                        placeholder="Search in External Relationship"
                        aria-label="Search"
                        aria-describedby="button-addon1" />
                        
                        <!--Search button-->
                    <button
                        class="relative z-[2] flex items-center rounded-r bg-primary px-6 py-2.5 text-xs font-medium uppercase leading-tight text-white shadow-md transition duration-150 ease-in-out hover:bg-primary-700 hover:shadow-lg focus:bg-primary-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-primary-800 active:shadow-lg"
                        type="button"
                        id="search-ExternalRelationship-button"
                        data-te-ripple-init
                        data-te-ripple-color="light">
                        <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                        class="h-5 w-5">
                        <path
                            fill-rule="evenodd"
                            d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                            clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
            <div id="datatable-ExternalRelationship" class="w-full py-5 rounded-xl"></div>
        </div>
        <div
        class="hidden opacity-0 transition-opacity duration-150 ease-linear data-[te-tab-active]:block"
        id="InformationSystem"
        role="tabpanel"
        aria-labelledby="tabs-InformationSystem">
            <h1 class="text-xl font-bold uppercase mb-1">Divisi Information System</h1>
            <hr class="h-[2px] bg-slate-200 dark:bg-gray-600 mb-8 border-none" />
            <div class="px-8 w-full mb-1">
                <div class="relative mb-4 flex w-full flex-wrap items-stretch">
                    <input
                        id="search-InformationSystem"
                        type="search"
                        class="relative m-0 -mr-0.5 block w-[1px] min-w-0 flex-auto rounded-l border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:focus:border-primary"
                        placeholder="Search in Information System"
                        aria-label="Search"
                        aria-describedby="button-addon1" />
                        
                        <!--Search button-->
                    <button
                        class="relative z-[2] flex items-center rounded-r bg-primary px-6 py-2.5 text-xs font-medium uppercase leading-tight text-white shadow-md transition duration-150 ease-in-out hover:bg-primary-700 hover:shadow-lg focus:bg-primary-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-primary-800 active:shadow-lg"
                        type="button"
                        id="search-InformationSystem-button"
                        data-te-ripple-init
                        data-te-ripple-color="light">
                        <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                        class="h-5 w-5">
                        <path
                            fill-rule="evenodd"
                            d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                            clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
            <div id="datatable-InformationSystem" class="w-full py-5 rounded-xl"></div>
        </div>
        <div
        class="hidden opacity-0 transition-opacity duration-150 ease-linear data-[te-tab-active]:block"
        id="Academic"
        role="tabpanel"
        aria-labelledby="tabs-Academic">
            <h1 class="text-xl font-bold uppercase mb-1">Divisi Academic</h1>
            <hr class="h-[2px] bg-slate-200 dark:bg-gray-600 mb-8 border-none" />
            <div class="px-8 w-full mb-1">
                <div class="relative mb-4 flex w-full flex-wrap items-stretch">
                    <input
                        id="search-Academic"
                        type="search"
                        class="relative m-0 -mr-0.5 block w-[1px] min-w-0 flex-auto rounded-l border border-solid border-neutral-300 bg-transparent bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6] text-neutral-700 outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-neutral-700 focus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:focus:border-primary"
                        placeholder="Search in Academic"
                        aria-label="Search"
                        aria-describedby="button-addon1" />
                        
                        <!--Search button-->
                    <button
                        class="relative z-[2] flex items-center rounded-r bg-primary px-6 py-2.5 text-xs font-medium uppercase leading-tight text-white shadow-md transition duration-150 ease-in-out hover:bg-primary-700 hover:shadow-lg focus:bg-primary-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-primary-800 active:shadow-lg"
                        type="button"
                        id="search-Academic-button"
                        data-te-ripple-init
                        data-te-ripple-color="light">
                        <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20"
                        fill="currentColor"
                        class="h-5 w-5">
                        <path
                            fill-rule="evenodd"
                            d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                            clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
            <div id="datatable-Academic" class="w-full py-5 rounded-xl"></div>
        </div>
    </div>
</div>
@endsection()

@section('script')
    <script>
        const data = JSON.parse(@json($accepted));
        
        // Datatable document
        const ID = document.getElementById("datatable-InternalDevelopment");
        const CnB = document.getElementById("datatable-CreativenBranding");
        const HRD = document.getElementById("datatable-HumanResource");
        const XR = document.getElementById("datatable-ExternalRelationship");
        const IS = document.getElementById("datatable-InformationSystem");
        const AC = document.getElementById("datatable-Academic");

        // Inisialisasi Datatable
        // Divisi Internal Development
        const instanceID = new te.Datatable(
            ID,
            {
                columns: [
                    { label: "NRP", field: "nrp", fixed : true, sort: true },
                    { label: "Name", field: "name", fixed : true, sort: true },
                    { label: "Major", field: "major", sort : false},
                    { label: "gpa", field: "gpa", sort : true },
                    { label: "Address", field: "address", sort: false},
                    { label: "Type", field: "type", sort: false},
                    { label: "Action", field: "action"},
                ],
                rows: data.id.map((item) => {
                    return {
                        ...item,
                        action : `
                        <a href="${item.link}" target="_blank">
                            <button
                                type="button"
                                data-te-ripple-init
                                data-te-ripple-color="light"
                                class="message-btn inline-block rounded-full border border-primary bg-primary text-white p-1.5 uppercase leading-normal shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">
                                <svg class="w-3.5 h-3.5 fill-[#ffffff]" viewBox="0 0 192 512" xmlns="http://www.w3.org/2000/svg">

                                <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                <path d="M48 80a48 48 0 1 1 96 0A48 48 0 1 1 48 80zM0 224c0-17.7 14.3-32 32-32H96c17.7 0 32 14.3 32 32V448h32c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H64V256H32c-17.7 0-32-14.3-32-32z"></path>

                                </svg>
                            </button>
                        </a>
                        `,
                        type : item.type == 2 ? "Choice 1" : item.type == 4 ? "Choice 2" : "Kidnapped",
                    }
                }),
            },
            { hover: true, stripped : true }
        );

        // Divisi Creative n Branding
        const instanceCnB = new te.Datatable(
            CnB,
            {
                columns: [
                    { label: "NRP", field: "nrp", fixed : true, sort: true },
                    { label: "Name", field: "name", fixed : true, sort: true },
                    { label: "Major", field: "major", sort : false},
                    { label: "gpa", field: "gpa", sort : true },
                    { label: "Address", field: "address", sort: false},
                    { label: "Type", field: "type", sort: false},
                    { label: "Action", field: "action"},
                ],
                rows: data.cnb.map((item) => {
                    return {
                        ...item,
                        action : `
                        <a href="${item.link}" target="_blank">
                            <button
                                type="button"
                                data-te-ripple-init
                                data-te-ripple-color="light"
                                class="message-btn inline-block rounded-full border border-primary bg-primary text-white p-1.5 uppercase leading-normal shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">
                                <svg class="w-3.5 h-3.5 fill-[#ffffff]" viewBox="0 0 192 512" xmlns="http://www.w3.org/2000/svg">

                                <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                <path d="M48 80a48 48 0 1 1 96 0A48 48 0 1 1 48 80zM0 224c0-17.7 14.3-32 32-32H96c17.7 0 32 14.3 32 32V448h32c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H64V256H32c-17.7 0-32-14.3-32-32z"></path>

                                </svg>
                            </button>
                        </a>
                        `,
                        type : item.type == 2 ? "Choice 1" : item.type == 4 ? "Choice 2" : "Kidnapped",
                    }
                }),
            },
            { hover: true, stripped : true }
        );

        // Divisi Human Resource
        const instanceHRD = new te.Datatable(
            HRD,
            {
                columns: [
                    { label: "NRP", field: "nrp", fixed : true, sort: true },
                    { label: "Name", field: "name", fixed : true, sort: true },
                    { label: "Major", field: "major", sort : false},
                    { label: "gpa", field: "gpa", sort : true },
                    { label: "Address", field: "address", sort: false},
                    { label: "Type", field: "type", sort: false},
                    { label: "Action", field: "action"},
                ],
                rows: data.hrd.map((item) => {
                    return {
                        ...item,
                        action : `
                        <a href="${item.link}" target="_blank">
                            <button
                                type="button"
                                data-te-ripple-init
                                data-te-ripple-color="light"
                                class="message-btn inline-block rounded-full border border-primary bg-primary text-white p-1.5 uppercase leading-normal shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">
                                <svg class="w-3.5 h-3.5 fill-[#ffffff]" viewBox="0 0 192 512" xmlns="http://www.w3.org/2000/svg">

                                <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                <path d="M48 80a48 48 0 1 1 96 0A48 48 0 1 1 48 80zM0 224c0-17.7 14.3-32 32-32H96c17.7 0 32 14.3 32 32V448h32c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H64V256H32c-17.7 0-32-14.3-32-32z"></path>

                                </svg>
                            </button>
                        </a>
                        `,
                        type : item.type == 2 ? "Choice 1" : item.type == 4 ? "Choice 2" : "Kidnapped",
                    }
                }),
            },
            { hover: true, stripped : true }
        );

        // Divisi External Relationship
        const instanceXR = new te.Datatable(
            XR,
            {
                columns: [
                    { label: "NRP", field: "nrp", fixed : true, sort: true },
                    { label: "Name", field: "name", fixed : true, sort: true },
                    { label: "Major", field: "major", sort : false},
                    { label: "gpa", field: "gpa", sort : true },
                    { label: "Address", field: "address", sort: false},
                    { label: "Type", field: "type", sort: false},
                    { label: "Action", field: "action"},
                ],
                rows: data.xr.map((item) => {
                    return {
                        ...item,
                        action : `
                        <a href="${item.link}" target="_blank">
                            <button
                                type="button"
                                data-te-ripple-init
                                data-te-ripple-color="light"
                                class="message-btn inline-block rounded-full border border-primary bg-primary text-white p-1.5 uppercase leading-normal shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">
                                <svg class="w-3.5 h-3.5 fill-[#ffffff]" viewBox="0 0 192 512" xmlns="http://www.w3.org/2000/svg">

                                <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                <path d="M48 80a48 48 0 1 1 96 0A48 48 0 1 1 48 80zM0 224c0-17.7 14.3-32 32-32H96c17.7 0 32 14.3 32 32V448h32c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H64V256H32c-17.7 0-32-14.3-32-32z"></path>

                                </svg>
                            </button>
                        </a>
                        `,
                        type : item.type == 2 ? "Choice 1" : item.type == 4 ? "Choice 2" : "Kidnapped",
                    }
                }),
            },
            { hover: true, stripped : true }
        );

        // Divisi Information System
        const instanceIS = new te.Datatable(
            IS,
            {
                columns: [
                    { label: "NRP", field: "nrp", fixed : true, sort: true },
                    { label: "Name", field: "name", fixed : true, sort: true },
                    { label: "Major", field: "major", sort : false},
                    { label: "gpa", field: "gpa", sort : true },
                    { label: "Address", field: "address", sort: false},
                    { label: "Type", field: "type", sort: false},
                    { label: "Action", field: "action"},
                ],
                rows: data.is.map((item) => {
                    return {
                        ...item,
                        action : `
                        <a href="${item.link}" target="_blank">
                            <button
                                type="button"
                                data-te-ripple-init
                                data-te-ripple-color="light"
                                class="message-btn inline-block rounded-full border border-primary bg-primary text-white p-1.5 uppercase leading-normal shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">
                                <svg class="w-3.5 h-3.5 fill-[#ffffff]" viewBox="0 0 192 512" xmlns="http://www.w3.org/2000/svg">

                                <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                <path d="M48 80a48 48 0 1 1 96 0A48 48 0 1 1 48 80zM0 224c0-17.7 14.3-32 32-32H96c17.7 0 32 14.3 32 32V448h32c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H64V256H32c-17.7 0-32-14.3-32-32z"></path>

                                </svg>
                            </button>
                        </a>
                        `,
                        type : item.type == 2 ? "Choice 1" : item.type == 4 ? "Choice 2" : "Kidnapped",
                    }
                }),
            },
            { hover: true, stripped : true }
        );

        // Divisi Academic
        const instanceAC = new te.Datatable(
            AC,
            {
                columns: [
                    { label: "NRP", field: "nrp", fixed : true, sort: true },
                    { label: "Name", field: "name", fixed : true, sort: true },
                    { label: "Major", field: "major", sort : false},
                    { label: "gpa", field: "gpa", sort : true },
                    { label: "Address", field: "address", sort: false},
                    { label: "Type", field: "type", sort: false},
                    { label: "Action", field: "action"},
                ],
                rows: data.ac.map((item) => {
                    return {
                        ...item,
                        action : `
                        <a href="${item.link}" target="_blank">
                            <button
                                type="button"
                                data-te-ripple-init
                                data-te-ripple-color="light"
                                class="message-btn inline-block rounded-full border border-primary bg-primary text-white p-1.5 uppercase leading-normal shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">
                                <svg class="w-3.5 h-3.5 fill-[#ffffff]" viewBox="0 0 192 512" xmlns="http://www.w3.org/2000/svg">

                                <!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                <path d="M48 80a48 48 0 1 1 96 0A48 48 0 1 1 48 80zM0 224c0-17.7 14.3-32 32-32H96c17.7 0 32 14.3 32 32V448h32c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H64V256H32c-17.7 0-32-14.3-32-32z"></path>

                                </svg>
                            </button>
                        </a>
                        `,
                        type : item.type == 2 ? "Choice 1" : item.type == 4 ? "Choice 2" : "Kidnapped",
                    }
                }),
            },
            { hover: true, stripped : true }
        );


        // Search Function
        // ID
        const inputAcara = document.getElementById('search-InternalDevelopment');

        const searchAcara = (value) => {
            let [phrase, columns] = value.split(" in:").map((str) => str.trim());

            if (columns) {
            columns = columns.split(",").map((str) => str.toLowerCase().trim());
            }

            instanceID.search(phrase, columns);
        };

        document
            .getElementById("search-InternalDevelopment-button")
            .addEventListener("click", (e) => {
            searchAcara(inputAcara.value);
            });

        inputAcara.addEventListener("keydown", (e) => {
            searchAcara(e.target.value);
        });

        // Perlengkapan
        const inputPerkap = document.getElementById('search-CreativenBranding');

        const searchPerkap = (value) => {
            let [phrase, columns] = value.split(" in:").map((str) => str.trim());

            if (columns) {
            columns = columns.split(",").map((str) => str.toLowerCase().trim());
            }

            instanceCnB.search(phrase, columns);
        };

        document
            .getElementById("search-CreativenBranding-button")
            .addEventListener("click", (e) => {
            searchPerkap(inputPerkap.value);
            });

        inputPerkap.addEventListener("keydown", (e) => {
            searchPerkap(e.target.value);
        });

        // Regulasi
        const inputRegul = document.getElementById('search-HumanResource');

        const searchRegul = (value) => {
            let [phrase, columns] = value.split(" in:").map((str) => str.trim());

            if (columns) {
            columns = columns.split(",").map((str) => str.toLowerCase().trim());
            }

            instanceHRD.search(phrase, columns);
        };

        document
            .getElementById("search-HumanResource-button")
            .addEventListener("click", (e) => {
            searchRegul(inputRegul.value);
            });

        inputRegul.addEventListener("keydown", (e) => {
            searchRegul(e.target.value);
        });

        // Creative
        const inputCreative = document.getElementById('search-ExternalRelationship');

        const searchCreative = (value) => {
            let [phrase, columns] = value.split(" in:").map((str) => str.trim());

            if (columns) {
            columns = columns.split(",").map((str) => str.toLowerCase().trim());
            }

            instanceXR.search(phrase, columns);
        };

        document
            .getElementById("search-ExternalRelationship-button")
            .addEventListener("click", (e) => {
            searchCreative(inputCreative.value);
            });

        inputCreative.addEventListener("keydown", (e) => {
            searchCreative(e.target.value);
        });

        // Sekretariat
        const inputSekret = document.getElementById('search-InformationSystem');

        const searchSekret = (value) => {
            let [phrase, columns] = value.split(" in:").map((str) => str.trim());

            if (columns) {
            columns = columns.split(",").map((str) => str.toLowerCase().trim());
            }

            instanceIS.search(phrase, columns);
        };

        document
            .getElementById("search-InformationSystem-button")
            .addEventListener("click", (e) => {
            searchSekret(inputSekret.value);
            });

        inputSekret.addEventListener("keydown", (e) => {
            searchSekret(e.target.value);
        });

        // IT
        const inputIT = document.getElementById('search-Academic');

        const searchIT = (value) => {
            let [phrase, columns] = value.split(" in:").map((str) => str.trim());

            if (columns) {
            columns = columns.split(",").map((str) => str.toLowerCase().trim());
            }

            instanceAC.search(phrase, columns);
        };

        document
            .getElementById("search-Academic-button")
            .addEventListener("click", (e) => {
            searchIT(inputIT.value);
            });

        inputIT.addEventListener("keydown", (e) => {
            searchIT(e.target.value);
        });
    </script>
@endsection()