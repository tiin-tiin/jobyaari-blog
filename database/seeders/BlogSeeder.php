<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $blogs = [
            [
                'title'             => 'SSC CGL 2026 Admit Card Released — Download Now',
                'category'          => 'Admit Card',
                'short_description' => 'Staff Selection Commission has released the SSC CGL Tier-1 2026 admit card. Candidates can download their hall tickets from the official SSC portal.',
                'content'           => '<h2>SSC CGL 2026 Admit Card</h2><p>The Staff Selection Commission (SSC) has officially released the Combined Graduate Level (CGL) Tier-1 2026 admit card. Candidates who had applied for the recruitment can now download their hall tickets from the official SSC website.</p><h3>How to Download</h3><ul><li>Visit the official SSC website at ssc.gov.in</li><li>Click on "Admit Card" section</li><li>Select "SSC CGL 2026 Tier-1"</li><li>Enter your Registration Number and Date of Birth</li><li>Download and print the admit card</li></ul><h3>Exam Details</h3><p>The SSC CGL Tier-1 exam will be conducted in Computer Based Test (CBT) mode. Candidates must carry a valid photo ID along with the admit card on the day of examination.</p>',
            ],
            [
                'title'             => 'UPSC Civil Services Prelims 2026 Result Declared',
                'category'          => 'Result',
                'short_description' => 'UPSC has declared the Civil Services Preliminary Examination 2026 result. Qualified candidates can check their roll numbers on the official website.',
                'content'           => '<h2>UPSC CSE Prelims 2026 Result</h2><p>The Union Public Service Commission (UPSC) has announced the result of the Civil Services (Preliminary) Examination, 2026. Candidates who appeared for the exam can now check their result on the official UPSC website.</p><h3>How to Check Result</h3><ul><li>Go to upsc.gov.in</li><li>Navigate to "What\'s New" section</li><li>Click on "Civil Services Preliminary Exam 2026 Result"</li><li>Find your roll number in the PDF list</li></ul><h3>Next Step: Mains Examination</h3><p>Candidates who qualify the Preliminary examination will be eligible to appear for the UPSC Civil Services Mains Examination. The application for Mains will be available shortly on the official website.</p>',
            ],
            [
                'title'             => 'Indian Railway Recruitment 2026 — 5000+ Vacancies',
                'category'          => 'Latest Jobs',
                'short_description' => 'Indian Railways has announced massive recruitment for over 5000 posts across various departments. Apply online before the deadline.',
                'content'           => '<h2>Railway Recruitment 2026</h2><p>Indian Railways has released a massive recruitment notification for over 5,000 vacancies across different zones. This is a great opportunity for candidates looking for government jobs in the railway sector.</p><h3>Post Details</h3><ul><li>Group D (Track Maintainer, Helper) — 3500 posts</li><li>Junior Clerk cum Typist — 800 posts</li><li>Station Master — 400 posts</li><li>Junior Engineer — 350 posts</li></ul><h3>Eligibility</h3><p>Minimum educational qualification is 10th pass for Group D posts. Graduate degree required for clerical and engineering posts. Age limit: 18-33 years (relaxation applicable for reserved categories).</p><h3>How to Apply</h3><p>Candidates can apply online through the official Railway Recruitment Board (RRB) website of their respective zone. The online application window will remain open for 30 days from the notification date.</p>',
            ],
            [
                'title'             => 'PM Kisan Samman Nidhi — 17th Installment Release Date',
                'category'          => 'Scheme',
                'short_description' => 'The government is set to release the 17th installment of PM Kisan Samman Nidhi scheme. Check eligibility and how to verify your beneficiary status.',
                'content'           => '<h2>PM Kisan 17th Installment</h2><p>The Government of India is set to release the 17th installment of the Pradhan Mantri Kisan Samman Nidhi (PM-KISAN) scheme. Under this scheme, eligible farmer families receive Rs 6,000 per year in three equal installments of Rs 2,000 each.</p><h3>How to Check Beneficiary Status</h3><ul><li>Visit pmkisan.gov.in</li><li>Click on "Beneficiary Status"</li><li>Enter Aadhaar Number or Account Number or Mobile Number</li><li>Click "Get Data" to see your status</li></ul><h3>eKYC is Mandatory</h3><p>All beneficiaries must complete eKYC to receive the installment. eKYC can be done through the PM-KISAN mobile app or by visiting the nearest CSC center.</p>',
            ],
            [
                'title'             => 'How to Crack SSC CGL in 3 Months — Complete Strategy',
                'category'          => 'Exam Tips',
                'short_description' => 'A complete 3-month study plan to crack SSC CGL with subject-wise tips, best books, and time management strategy for working aspirants.',
                'content'           => '<h2>SSC CGL 3-Month Strategy</h2><p>Cracking SSC CGL in 3 months is challenging but absolutely achievable with the right strategy and consistent effort. Here is a proven month-wise plan.</p><h3>Month 1: Build Foundation</h3><ul><li><strong>Quantitative Aptitude:</strong> Complete basic math (Number System, Percentage, Ratio)</li><li><strong>English:</strong> Grammar rules, Reading Comprehension basics</li><li><strong>GK:</strong> Start with Static GK — History, Geography, Polity</li><li><strong>Reasoning:</strong> Series, Analogy, Classification</li></ul><h3>Month 2: Practice & Speed</h3><ul><li>Solve previous year papers (2018–2025)</li><li>Topic-wise mock tests daily</li><li>Identify weak areas and revisit</li></ul><h3>Month 3: Full Mock Tests</h3><ul><li>2 full-length mocks per day</li><li>Analyse every mock thoroughly</li><li>Focus on accuracy over speed</li><li>Revise notes daily</li></ul><h3>Best Books</h3><ul><li>Maths: R.S. Aggarwal or Rakesh Yadav</li><li>English: Plinth to Paramount</li><li>GK: Lucent GK</li><li>Reasoning: R.S. Aggarwal Verbal & Non-Verbal</li></ul>',
            ],
            [
                'title'             => 'IBPS PO 2026 Answer Key Released — Raise Objections by This Date',
                'category'          => 'Answer Key',
                'short_description' => 'IBPS has released the provisional answer key for PO Prelims 2026. Candidates can challenge incorrect answers by paying Rs 200 per question.',
                'content'           => '<h2>IBPS PO Answer Key 2026</h2><p>The Institute of Banking Personnel Selection (IBPS) has released the provisional answer key for the IBPS PO Preliminary Examination 2026. Candidates who appeared in the exam can now access and challenge the answer key through the official website.</p><h3>Steps to Download Answer Key</h3><ul><li>Visit ibps.in</li><li>Click on "CRP PO/MT-XVI" link</li><li>Login with your Registration Number and Password</li><li>Download the answer key PDF</li></ul><h3>Raise Objections</h3><p>If you believe any answer in the official key is incorrect, you can raise an objection online. Each objection requires a fee of Rs 200 per question, which will be refunded if your objection is accepted.</p><h3>Last Date</h3><p>The last date to raise objections is within 5 days of the answer key release. No requests will be entertained after the deadline.</p>',
            ],
        ];

        foreach ($blogs as $data) {
            $data['slug'] = Blog::generateUniqueSlug($data['title']);
            Blog::create($data);
        }

        $this->command->info('✅ 6 sample blog posts seeded successfully!');
    }
}