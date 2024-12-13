## Theme Setup

1 - Create a new Magento theme as a child of one of the existing Magento themes:
`app/design/frontend/Test/default/theme.xml`

2 - Set the theme to the main Magento store view programmatically:
`app/code/Test/Theme/Setup/InstallData.php`

## PLP

1 - Create a new category attribute programmatically called "Subtitle"
`app/code/Test/Catalog/Setup/Patch/Data/AddCategorySubtitleField.php`

2 - Add it to the admin category view underneath ‘Name’
`app/code/Test/Catalog/view/adminhtml/ui_component/category_form.xml`

## Set Category Data (incomplete)

Programmatically set the following data to one of your categories:

- Name
- Subtitle
- Image (use desktop-background.jpg provided)
- Description (use lorem ipsum)

`app/code/Test/Catalog/Setup/Patch/Data/UpdateWomanCategory.php`

## Frontend (using blank theme font)

- The title, subtitle and image must come from the category and not be hardcoded
- The lorem ipsum text is the category description
- Get as close to the design as possible. Watch out for spacing and sizes

`app/design/Test/default`
