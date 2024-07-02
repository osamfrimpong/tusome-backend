<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    protected $categories = [
        [
            'name' => 'High School',
            'description' => 'Past questions for high schools in Ghana and Kenya',
            'is_active' => true,
            'children' => [
                [
                    'name' => 'Ghana',
                    'description' => 'High school past questions in Ghana',
                    'is_active' => true,
                    'children' => [
                        [
                            'name' => 'WASSCE',
                            'description' => 'West African Senior School Certificate Examination past questions',
                            'is_active' => true,
                            'children' => [
                                ['name' => 'Mathematics', 'description' => 'Math past questions', 'is_active' => true],
                                ['name' => 'English', 'description' => 'English past questions', 'is_active' => true],
                                ['name' => 'Science', 'description' => 'Science past questions', 'is_active' => true],
                                ['name' => 'Social Studies', 'description' => 'Social Studies past questions', 'is_active' => true],
                                ['name' => 'Biology', 'description' => 'Biology past questions', 'is_active' => true],
                                ['name' => 'Chemistry', 'description' => 'Chemistry past questions', 'is_active' => true],
                                ['name' => 'Physics', 'description' => 'Physics past questions', 'is_active' => true],
                                ['name' => 'Economics', 'description' => 'Economics past questions', 'is_active' => true],
                                ['name' => 'Geography', 'description' => 'Geography past questions', 'is_active' => true],
                                ['name' => 'History', 'description' => 'History past questions', 'is_active' => true],
                                ['name' => 'Literature', 'description' => 'Literature past questions', 'is_active' => true],
                                // Add other subjects as needed
                            ]
                        ],
                        [
                            'name' => 'BECE',
                            'description' => 'Basic Education Certificate Examination past questions',
                            'is_active' => true,
                            'children' => [
                                ['name' => 'Mathematics', 'description' => 'Math past questions', 'is_active' => true],
                                ['name' => 'English', 'description' => 'English past questions', 'is_active' => true],
                                ['name' => 'Science', 'description' => 'Science past questions', 'is_active' => true],
                                ['name' => 'Social Studies', 'description' => 'Social Studies past questions', 'is_active' => true],
                                ['name' => 'French', 'description' => 'French past questions', 'is_active' => true],
                                ['name' => 'ICT', 'description' => 'ICT past questions', 'is_active' => true],
                                // Add other subjects as needed
                            ]
                        ],
                        // Add other exams as needed
                    ]
                ],
                [
                    'name' => 'Kenya',
                    'description' => 'High school past questions in Kenya',
                    'is_active' => true,
                    'children' => [
                        [
                            'name' => 'KCSE',
                            'description' => 'Kenya Certificate of Secondary Education past questions',
                            'is_active' => true,
                            'children' => [
                                ['name' => 'Mathematics', 'description' => 'Math past questions', 'is_active' => true],
                                ['name' => 'English', 'description' => 'English past questions', 'is_active' => true],
                                ['name' => 'Biology', 'description' => 'Biology past questions', 'is_active' => true],
                                ['name' => 'Chemistry', 'description' => 'Chemistry past questions', 'is_active' => true],
                                ['name' => 'Physics', 'description' => 'Physics past questions', 'is_active' => true],
                                ['name' => 'Geography', 'description' => 'Geography past questions', 'is_active' => true],
                                ['name' => 'History', 'description' => 'History past questions', 'is_active' => true],
                                ['name' => 'CRE', 'description' => 'Christian Religious Education past questions', 'is_active' => true],
                                ['name' => 'Business Studies', 'description' => 'Business Studies past questions', 'is_active' => true],
                                ['name' => 'Agriculture', 'description' => 'Agriculture past questions', 'is_active' => true],
                                // Add other subjects as needed
                            ]
                        ],
                        // Add other exams as needed
                    ]
                ]
            ]
        ],
        [
            'name' => 'University',
            'description' => 'Past questions for universities in Ghana and Kenya',
            'is_active' => true,
            'children' => [
                [
                    'name' => 'Ghana',
                    'description' => 'University past questions in Ghana',
                    'is_active' => true,
                    'children' => [
                        ['name' => 'Computer Science', 'description' => 'Computer Science past questions', 'is_active' => true],
                        ['name' => 'Business Administration', 'description' => 'Business Administration past questions', 'is_active' => true],
                        ['name' => 'Engineering', 'description' => 'Engineering past questions', 'is_active' => true],
                        ['name' => 'Medicine', 'description' => 'Medicine past questions', 'is_active' => true],
                        ['name' => 'Law', 'description' => 'Law past questions', 'is_active' => true],
                        ['name' => 'Economics', 'description' => 'Economics past questions', 'is_active' => true],
                        ['name' => 'Accounting', 'description' => 'Accounting past questions', 'is_active' => true],
                        ['name' => 'Marketing', 'description' => 'Marketing past questions', 'is_active' => true],
                        ['name' => 'Nursing', 'description' => 'Nursing past questions', 'is_active' => true],
                        ['name' => 'Education', 'description' => 'Education past questions', 'is_active' => true],
                        // Add other courses as needed
                    ]
                ],
                [
                    'name' => 'Kenya',
                    'description' => 'University past questions in Kenya',
                    'is_active' => true,
                    'children' => [
                        ['name' => 'Engineering', 'description' => 'Engineering past questions', 'is_active' => true],
                        ['name' => 'Medicine', 'description' => 'Medicine past questions', 'is_active' => true],
                        ['name' => 'Law', 'description' => 'Law past questions', 'is_active' => true],
                        ['name' => 'Business Administration', 'description' => 'Business Administration past questions', 'is_active' => true],
                        ['name' => 'Computer Science', 'description' => 'Computer Science past questions', 'is_active' => true],
                        ['name' => 'Economics', 'description' => 'Economics past questions', 'is_active' => true],
                        ['name' => 'Accounting', 'description' => 'Accounting past questions', 'is_active' => true],
                        ['name' => 'Marketing', 'description' => 'Marketing past questions', 'is_active' => true],
                        ['name' => 'Nursing', 'description' => 'Nursing past questions', 'is_active' => true],
                        ['name' => 'Education', 'description' => 'Education past questions', 'is_active' => true],
                        // Add other courses as needed
                    ]
                ]
            ]
        ],
        [
            'name' => 'Training Colleges',
            'description' => 'Past questions for training colleges in Ghana and Kenya',
            'is_active' => true,
            'children' => [
                [
                    'name' => 'Ghana',
                    'description' => 'Training colleges past questions in Ghana',
                    'is_active' => true,
                    'children' => [
                        ['name' => 'Teacher Training', 'description' => 'Teacher training college past questions', 'is_active' => true],
                        ['name' => 'Nursing Training', 'description' => 'Nursing training college past questions', 'is_active' => true],
                        ['name' => 'Technical Training', 'description' => 'Technical training college past questions', 'is_active' => true],
                        ['name' => 'Agricultural Training', 'description' => 'Agricultural training college past questions', 'is_active' => true],
                        // Add other categories as needed
                    ]
                ],
                [
                    'name' => 'Kenya',
                    'description' => 'Training colleges past questions in Kenya',
                    'is_active' => true,
                    'children' => [
                        ['name' => 'Teacher Training', 'description' => 'Teacher training college past questions', 'is_active' => true],
                        ['name' => 'Nursing Training', 'description' => 'Nursing training college past questions', 'is_active' => true],
                        ['name' => 'Technical Training', 'description' => 'Technical training college past questions', 'is_active' => true],
                        ['name' => 'Agricultural Training', 'description' => 'Agricultural training college past questions', 'is_active' => true],
                        // Add other categories as needed
                    ]
                ]
            ]
        ]
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Recursive function to create categories and subcategories
        function createCategories(array $categories, $parentId = null) {
            foreach ($categories as $categoryData) {
                $children = $categoryData['children'] ?? [];
                unset($categoryData['children']);
                $categoryData['parent_id'] = $parentId;
                $category = Category::create($categoryData);
                if (!empty($children)) {
                    createCategories($children, $category->id);
                }
            }
        }

        // Call the function to seed the categories
        createCategories($this->categories);
    }
}
