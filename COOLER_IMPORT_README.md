# Cooler Management System

A Laravel-based system for importing and managing outlet cooler data with advanced filtering capabilities.

## Features

- **CSV & Excel Import**: Upload cooler inventory data from CSV or XLSX files
- **Data Validation**: Automatic data validation and error handling
- **Advanced Filtering**: Filter data by:
  - Outlet Name (text search)
  - Login (text search)
  - Outlet Type (dropdown selection)
  - Number of Pepsi Coolers (minimum value)
  - Number of Cola Coolers (minimum value)
  - Number of Other Branded Coolers (minimum value)
- **Data Table**: Paginated table view with 50 records per page
- **Total Coolers**: Automatic calculation of total coolers per outlet

## Setup Instructions

### Database Migration
The database table has already been created. The system stores:
- **outlet_name**: Name of the outlet
- **login**: Login identifier
- **outlet_type**: Type of outlet
- **pepsi_coolers**: Number of Pepsi branded coolers
- **cola_coolers**: Number of Cola branded coolers
- **other_branded_coolers**: Number of other branded coolers

### File Requirements

Your import file must have the following columns in this exact order:
1. Outlet Name
2. Login
3. Outlet Type
4. Number of Pepsi Coolers
5. Number of Cola Coolers
6. Number of Other Branded Coolers

**Supported Formats**:
- CSV (.csv)
- Excel (.xlsx)
- Excel 97-2003 (.xls) - *Convert to CSV or XLSX for best results*

**File Size Limit**: 10MB

## Usage

### Importing Data

1. Navigate to `/coolers/import`
2. Click to select or drag and drop your CSV/Excel file
3. Click "Import Data"
4. Wait for confirmation message
5. View imported data in the table

### Viewing Data

1. Navigate to `/coolers` or click "View Data"
2. Browse through paginated results
3. Use filters to search for specific outlets or cooler counts
4. Click "Apply Filters" to update results
5. Click "Clear Filters" to reset all filters

### Sample File

A sample CSV file (`sample_coolers.csv`) is included in the project root. You can use this to test the import functionality.

## Sample CSV Format

```
Outlet Name,Login,Outlet Type,Number of Pepsi Coolers,Number of Cola Coolers,Number of Other Branded Coolers
ABC Supermarket,abc_super001,Supermarket,5,3,2
XYZ Convenience Store,xyz_conv001,Convenience Store,2,1,1
Fast Mart Outlet,fastmart001,Gas Station,3,4,1
```

## Routes

- `GET /coolers` - View all cooler data with filters
- `GET /coolers/import` - Show import form
- `POST /coolers/import` - Process file upload

## API Responses

### Import Success
```json
{
  "message": "Data imported successfully!"
}
```

### Import Error
```json
{
  "message": "Error importing file: [error details]"
}
```

## Error Handling

- **Invalid File Format**: Only CSV and Excel files are accepted
- **File Size Exceeded**: Maximum file size is 10MB
- **Missing Required Fields**: Empty rows are automatically skipped
- **Data Type Errors**: Non-numeric cooler counts default to 0

## Notes

- When importing new data, existing data is cleared (replaced)
- Multiple imports are supported; each import replaces previous data
- Text filters use "contains" matching (case-insensitive)
- Number filters use "greater than or equal to" matching
- The system automatically trims whitespace from text fields
- Invalid numeric values are converted to 0

## Troubleshooting

### Import fails with "Worksheet not found"
- Ensure your Excel file has a sheet named "sheet1" or is in standard format
- Try converting to CSV instead

### Numbers not importing correctly
- Ensure numeric columns don't contain text or special characters
- Numbers should be plain integers (e.g., 5, not "5 units")

### No data appears after import
- Check that your CSV/Excel file has the correct column order
- Verify the file is not empty (headers don't count)
- Check the browser console for error messages

## Technical Details

### Database Schema
```sql
CREATE TABLE coolers (
  id BIGINT PRIMARY KEY AUTO_INCREMENT,
  outlet_name VARCHAR(255) NOT NULL,
  login VARCHAR(255) NOT NULL,
  outlet_type VARCHAR(255),
  pepsi_coolers INT DEFAULT 0,
  cola_coolers INT DEFAULT 0,
  other_branded_coolers INT DEFAULT 0,
  created_at TIMESTAMP,
  updated_at TIMESTAMP,
  INDEX idx_outlet_name (outlet_name),
  INDEX idx_login (login)
);
```

### Import Process
1. File is validated
2. Existing data is cleared
3. File is parsed (CSV or XLSX)
4. Each row is validated and imported
5. Success message is displayed

### Performance
- CSV files: Fastest (native PHP parsing)
- XLSX files: Moderate speed (XML parsing from ZIP archive)
- Paginated display: 50 records per page
- Database indexes on outlet_name and login for fast filtering
