# User Management System

A comprehensive PHP-based user management system with organization and role management capabilities.

## Features

- **Organization Management**: Create, read, update, and delete organizations
- **Role Management**: Manage roles within organizations with proper relationships
- **User Management**: Complete user CRUD operations with role assignments
- **Modern UI**: Responsive design with Bootstrap-inspired styling
- **Database Normalization**: Properly normalized database schema with foreign key relationships
- **Security**: Input validation and SQL injection prevention using prepared statements

## Database Schema

The system uses three main tables:

### 1. `org_info` - Organizations
- `pk_org_id` (Primary Key)
- `org_name` - Organization name
- `org_email` - Organization email
- `org_password` - Organization password
- `org_updated_by` - Who updated the record
- `org_updated_on` - Timestamp of last update
- `org_status` - Active/Inactive status

### 2. `role_master` - Roles
- `pk_role_id` (Primary Key)
- `role_org_id` (Foreign Key to org_info)
- `role_name` - Role name (Admin, User, Data Entry Operator)
- `role_description` - Role description
- `role_updated_by` - Who updated the record
- `role_updated_on` - Timestamp of last update
- `role_status` - Active/Inactive status

### 3. `user_info` - Users
- `pk_user_id` (Primary Key)
- `user_org_id` (Foreign Key to org_info)
- `user_name` - User's full name
- `user_email` - User's email address
- `user_password` - User's password
- `user_role_id` (Foreign Key to role_master)
- `user_updated_by` - Who updated the record
- `user_updated_date_time` - Timestamp of last update
- `user_status` - Active/Inactive status

## Installation

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx)
- WAMP/XAMPP/LAMP stack

### Setup Instructions

1. **Clone/Download the project** to your web server directory:
   ```
   C:\wamp64\www\usermgmt\
   ```

2. **Database Setup**:
   - Create a MySQL database named `m2its`
   - Import the SQL file: `sql/user_mgmt.sql`
   - This will create all tables with sample data

3. **Database Configuration**:
   - Edit `config/database.php` if needed:
   ```php
   private $host = 'localhost';
   private $db_name = 'm2its';
   private $username = 'root';
   private $password = '';
   ```

4. **Access the Application**:
   - Open your web browser
   - Navigate to: `http://localhost/usermgmt/`
   - You should see the dashboard

## File Structure

```
usermgmt/
├── assets/
│   ├── css/
│   │   └── style.css          # Main stylesheet
│   └── js/
│       └── script.js          # JavaScript functions
├── config/
│   └── database.php           # Database configuration
├── models/
│   ├── OrgInfo.php           # Organization model
│   ├── RoleMaster.php        # Role model
│   └── UserInfo.php          # User model
├── pages/
│   ├── org_list.php          # Organization listing
│   ├── org_create.php        # Create organization
│   ├── org_edit.php          # Edit organization
│   ├── role_list.php         # Role listing
│   ├── role_create.php       # Create role
│   ├── user_list.php         # User listing
│   └── user_create.php       # Create user
├── sql/
│   └── user_mgmt.sql         # Database schema and data
├── index.php                 # Main dashboard
└── README.md                 # This file
```

## Usage

### Dashboard
- View system statistics (organizations, roles, users count)
- Quick access to create new records
- Navigation to different sections

### Organization Management
1. **View Organizations**: See all organizations in a table format
2. **Create Organization**: Add new organizations with required details
3. **Edit Organization**: Modify existing organization information
4. **Delete Organization**: Remove organizations (with confirmation)

### Role Management
1. **View Roles**: See all roles with their associated organizations
2. **Create Role**: Add new roles for specific organizations
3. **Edit Role**: Modify role details and descriptions
4. **Delete Role**: Remove roles (with confirmation)

### User Management
1. **View Users**: See all users with their organization and role information
2. **Create User**: Add new users with organization and role assignment
3. **Edit User**: Modify user details and role assignments
4. **Delete User**: Remove users (with confirmation)

## Key Features

### Security
- **Prepared Statements**: All database queries use prepared statements to prevent SQL injection
- **Input Validation**: Server-side validation for all form inputs
- **XSS Protection**: HTML entities encoding for output

### User Experience
- **Responsive Design**: Works on desktop, tablet, and mobile devices
- **Modern UI**: Clean, professional interface with smooth animations
- **Confirmation Dialogs**: Delete operations require confirmation
- **Success/Error Messages**: Clear feedback for all operations

### Database Design
- **Normalized Schema**: Proper database normalization with foreign key relationships
- **Referential Integrity**: Cascade delete/update for maintaining data consistency
- **Audit Trail**: Track who updated records and when

## Customization

### Adding New Fields
1. Update the database schema in `sql/user_mgmt.sql`
2. Modify the corresponding model class
3. Update the form pages (create/edit)
4. Update the list pages to display new fields

### Styling
- Modify `assets/css/style.css` for custom styling
- The CSS uses CSS Grid and Flexbox for modern layouts
- Color scheme can be easily changed by modifying CSS variables

### Functionality
- Add new CRUD operations by following the existing pattern
- Extend models with additional methods as needed
- Add new pages following the existing structure

## Troubleshooting

### Common Issues

1. **Database Connection Error**:
   - Check database credentials in `config/database.php`
   - Ensure MySQL service is running
   - Verify database name exists

2. **Page Not Found**:
   - Check file paths and directory structure
   - Ensure web server is properly configured
   - Check file permissions

3. **Form Submission Issues**:
   - Check PHP error logs
   - Verify form action URLs
   - Ensure all required fields are filled

### Error Logs
- Check PHP error logs in your web server configuration
- Enable error reporting in development: `error_reporting(E_ALL)`

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## License

This project is open source and available under the MIT License.

## Support

For support and questions, please create an issue in the project repository.

---

**Note**: This system is designed for educational and development purposes. For production use, consider implementing additional security measures such as:
- Password hashing (bcrypt)
- Session management
- CSRF protection
- Input sanitization libraries
- Rate limiting
