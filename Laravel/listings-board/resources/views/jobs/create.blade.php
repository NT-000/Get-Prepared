<x-layout title="Create Job">
    <div class="bg-white mx-auto p-8 rounded-lg shadow-md w-full md:max-w-3xl">
        <h2 class="text-4xl text-center font-bold mb-4">Create Job Listing</h2>
        <form method="POST" action="/jobs" enctype="multipart/form-data">
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">
                Job Info
            </h2>

            <div class="mb-4">
                <x-input
                    type="text"
                    label="Job Title"
                    name="jobTitle"
                    placeholder="Enter job title"
                    key="jobTitle"
                    val="jobTitle"
                />
            </div>

            <div class="mb-4">
                <x-input :isTextarea="true" key="title" val="title" label="Job Description"/>
            </div>

            <div class="mb-4">
                <x-input
                    type="number"
                    label="salary"
                    name="salary"
                    placeholder="Enter annual salary"
                    key="salary"
                    val="salary"
                />
            </div>

            <div class="mb-4">
                <x-input
                    :isTextarea="true"
                    label="Requirements"
                    name="requirements"
                    placeholder="Bachelor's degree in Computer Science"
                    key="requirements"
                    val="requirements"
                />
            </div>

            <div class="mb-4">
                <x-input
                    :isTextarea="true"
                    label="Benefits"
                    name="benefits"
                    placeholder="Enter employee benefits."
                    key="benefits"
                    val="benefits"
                />
            </div>

            <div class="mb-4">
                <x-input
                    type="text"
                    label="Tags"
                    name="tags"
                    placeholder="Type in tags separate each tag with a comma."
                    key="tags"
                    val="tags"
                />
            </div>

            <div class="mb-4">
                <x-select :jobOptions="$options" label="Job Type"/>
            </div>

            <div class="mb-4">
                <x-select :jobOptions="$options" label="Remote"/>
            </div>

            <div class="mb-4">

                <x-input
                    type="text"
                    label="Address"
                    name="address"
                    placeholder="Enter street address"
                    key="address"
                    val="address"
                />
            </div>

            <div class="mb-4">
                <x-input
                    type="text"
                    label="City"
                    name="city"
                    placeholder="Enter name of city"
                    key="city"
                    val="city"
                />
            </div>

            <div class="mb-4">
                <x-input
                    type="number"
                    label="ZIP Code"
                    name="zipCode"
                    key="zipCode"
                    val="zipCode"
                />
            </div>

            <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">
                Company Info
            </h2>

            <div class="mb-4">
                <x-input
                    type="text"
                    label="Company name"
                    name="companyName"
                    key="companyName"
                    val="companyName"
                />
            </div>

            <div class="mb-4">
                <x-input
                    type="text"
                    label="Company description"
                    name="companyName"
                    key="companyName"
                    val="companyName"
                />
            </div>

            <div class="mb-4">
                <x-input
                    label="Contact Website"
                    type="text"
                    name="company_website"
                    placeholder="Enter website"
                    key="company_website"
                    val="company_website"
                />
            </div>

            <div class="mb-4">
                <x-input
                    label="Contact Phone"
                    type="number"
                    name="contact_phone"
                    placeholder="Enter phone-number"
                    key="contact_phone"
                    val="contact_phone"
                />
            </div>

            <div class="mb-4">
                <x-input
                    label="Contact email"
                    type="email"
                    name="contact_email"
                    placeholder="Email"
                    key="contact_email"
                    val="contact_email"
                />
            </div>

            <div class="mb-4">
                <x-input
                    label="Company Logo"
                    type="file"
                    name="company_logo"
                />
            </div>

            <button
                type="submit"
                class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 my-3 rounded focus:outline-none"
            >
                Save
            </button>
        </form>
    </div>
</x-layout>
