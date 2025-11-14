<x-layout title="Create Job">
    <div class="bg-white mx-auto p-8 rounded-lg shadow-md w-full md:max-w-3xl">
        <h2 class="text-4xl text-center font-bold mb-4">Create Job Listing</h2>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <p class="font-bold mb-2">Please fix the following errors:</p>
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{route('jobs.store')}}" enctype="multipart/form-data">
            @csrf
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">
                Job Info
            </h2>

            <x-inputs.input
                type="text"
                label="Job Title"
                name="title"
                placeholder="Enter job title"
                val="title"
            />

            <x-inputs.input
                :isTextarea="true"
                label="Job Description"
                name="description"
                placeholder="Enter job description"
                val="description"
            />

            <x-inputs.input
                type="number"
                label="Salary"
                name="salary"
                placeholder="Enter annual salary"
                val="salary"
            />

            <x-inputs.input
                :isTextarea="true"
                label="Requirements"
                name="requirements"
                placeholder="Bachelor's degree in Computer Science"
                val="requirements"
            />

            <x-inputs.input
                :isTextarea="true"
                label="Benefits"
                name="benefits"
                placeholder="Enter employee benefits."
                val="benefits"
            />

            <x-inputs.input
                type="text"
                label="Tags"
                name="tags"
                placeholder="Type in tags separate each tag with a comma"
                val="tags"
            />

            <div class="mb-4">
                <x-inputs.select name="job_type" :jobOptions="$options" label="Job Type"/>
            </div>

            <div class="mb-4">
                <x-inputs.select name="remote" :jobOptions="['0' => 'No', '1' => 'Yes']" label="Remote"/>
            </div>

            <x-inputs.input
                type="text"
                label="Address"
                name="address"
                placeholder="Enter street address"
                val="address"
            />

            <x-inputs.input
                type="text"
                label="City"
                name="city"
                placeholder="Enter name of city"
                val="city"
            />

            <x-inputs.input
                type="text"
                label="Country"
                name="country"
                placeholder="Enter country"
                val="country"
            />

            <x-inputs.input
                type="text"
                label="ZIP Code"
                name="zipcode"
                placeholder="Enter ZIP code"
                val="zipcode"
            />

            <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">
                Company Info
            </h2>

            <x-inputs.input
                type="text"
                label="Company name"
                name="company_name"
                val="company_name"
            />

            <x-inputs.input
                type="text"
                label="Company description"
                name="company_description"
                val="company_description"
            />

            <x-inputs.input
                label="Company Website"
                type="url"
                name="company_website"
                placeholder="Enter website"
                val="company_website"
            />

            <x-inputs.input
                label="Contact Phone"
                type="number"
                name="contact_phone"
                placeholder="Enter phone-number"
                val="contact_phone"
            />

            <x-inputs.input
                label="Contact email"
                type="email"
                name="contact_email"
                placeholder="Email"
                val="contact_email"
            />

            <x-inputs.input
                label="Company Logo"
                type="file"
                name="company_logo"
            />
            @error("company_logo")
            <p class="text-red-600 mt-2 text-sm">{{$message}}</p>
            @enderror

            <button
                type="submit"
                class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 my-3 rounded focus:outline-none"
            >
                Save
            </button>
        </form>
    </div>
</x-layout>
