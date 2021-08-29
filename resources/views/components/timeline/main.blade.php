<div class="container mx-auto w-full h-full">
    <div class="relative wrap overflow-hidden p-10 h-full">
        <div class="flex justify-center items-start">
            <span style="font-size: 3em;" class="text-indigo-800">
                <i class="fas fa-question-circle"></i>
              </span>
        </div>
        <div class="absolute border-dashed border-2 border-indigo-800 h-full" style="left: 50%"></div>
        <x-timeline.section
            direction='right-timeline'
            title='Supplycart Technologies'
            titleLink="https://www.supplycart.my/"
            year="2019 - 2021"
            tools="Laravel, Vue.Js, Tailwind, InertiaJs, MySQL, Postgres, Linux, PhpUnit"
            image="{{ local_images('supplycart_logo.png') }}"
        >
            <li>Developed and improved procurement processes.</li>
            <li>Worked on both internal tools and product website.</li>
            <b class="underline">Internal</b>
            <ul class="pl-4 list-disc">
                <li>
                    Products, Orders, Suppliers, Supplier Products, Companies, Settings, Bill Checking, Analytics, Product Matching
                </li>
            </ul>
            <b class="underline">Product</b>
            <ul class="pl-4 list-disc">
                <li>
                    Procure, Purchase Request, Purchase Order, Procure, RFQ, Budget, Export & Import data, 
                    Payment Service, Analytics
                </li>
            </ul>
            <li>Picked up Domain Driven Design and helped refactor codebase.</li>
            <li>Created Wordpress Plugin to display product catalog on landing page</li>
            <li>Setup Google Tag Manager to provide data to Google Analytics</li>
            <li>Mentor for several coding interns.</li>
        </x-timeline.section>

        <x-timeline.section
            direction='left-timeline flex-row-reverse'
            title='Finatext Malaysia'
            titleLink="https://finatext.com/"
            year="2017 - 2019"
            tools="Ruby On Rails, Google Analytics, Adjust, FB Pixels, Google Scripts, Zapier"
            image="{{ local_images('finatext_logo.png') }}"
        >
            <li>Requirement gathering and testing of Pipster mobile application.</li>
            <li>Designing functional specifications for new mobile applications and change requests.</li>
            <li>Setting up analytic tools for product.</li>
            <li>Used google scripts for automation.</li>
            <li>Has helped to setup EC2 instance to host an existing web application.</li>
            <li>Traveled to Vietnam to work along side developers.</li>
        </x-timeline.section>

        <x-timeline.section
            direction='right-timeline'
            title='DXC Technology'
            titleLink="https://www.dxc.com/my/en"
            year="2014 - 2017"
            tools="AS400, SMART400, CLLE, CL/400, IBM DB2//400 relational database"
            image="{{ local_images('dxc_logo.png') }}"
            
        >
            <li>Data migration to new GROUP/400 system.</li>
            <li>Develop new and enhance existing programs.</li>
            <li>Create & enhance business objects, screens, reports, table programs, batch programs</li>
            <li>Worked along side with clients in UAT closely to achieve requirements.</li>
            <li>Impact analysis and preparing documentation for change requests.</li>
            <li>Performed data analysis study to fix user’s corrupted data by data patching.</li>
            <li>Traveled overseas for other projects which involved Data Migration.</li>
        </x-timeline.section>
    </div>
    <div class="flex justify-center items-start">
        <span style="font-size: 1em;" class="text-white">
            <i class="fas fa-graduation-cap"></i>
            <b><a href="https://monash.edu.my/" class="hover:underline hover:text-blue-800">Graduated 2013 (Sunway Monash)</a></b>
        </span>
    </div>
</div>