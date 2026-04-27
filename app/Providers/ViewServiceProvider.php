<?php

namespace App\Providers;

use Illuminate\Support\{Facades\Blade, Facades\View, ServiceProvider};

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $components = [
            'TableRow' => 'organisms.tables.table-row',
            '\\Rows\\UserTableRow' => 'organisms.tables.rows.user',
            '\\Rows\\StudentTableRow' => 'organisms.tables.rows.student',
            '\\Rows\\AppointmentTableRow' => 'organisms.tables.rows.appointment',
            '\\Rows\\AuditLogTableRow' => 'organisms.tables.rows.audit-log',
            'PaginationResults' => 'organisms.navigation.pagination-results',
            'AuditLogGroup' => 'atoms.buttons.action-buttons.audit-log-group',
            'Sort' => 'organisms.navigation.sort',
            'Search' => 'organisms.navigation.search',
            'RowsPerPage' => 'organisms.navigation.rows-per-page',
            'FilterButtonGroup' => 'atoms.buttons.button-groups.filter-button-group',
            'GoogleForm' => 'google-forms.base',
            'InfoSection' => 'google-forms.info-section',
            'NoticeEmail' => 'layouts.notice-email',
            'OTPEmail' => 'layouts.otp-email',
            'UserProfileModal' => 'molecules.modals.user-profile-modal',
            'RescheduleAppointmentModal' => 'molecules.modals.reschedule-appointment-modal',
            'PageButtonGroup' => 'atoms.buttons.button-groups.page-button-group',
            'AuditLogButtonGroup' => 'atoms.buttons.button-groups.audit-log-button-group',
            'Sidebar' => 'organisms.layouts.sidebar',
            'ListType' => 'pages.list-type',
            'EmptyState' => 'organisms.tables.empty-state',
            'TemplateSidebar' => 'molecules.sidebars.template-sidebar',
            'ReportsSidebar' => 'molecules.sidebars.reports-sidebar',
            'AuditLogsSidebar' => 'molecules.sidebars.audit-logs-sidebar',
            'SubmissionsSidebar' => 'molecules.sidebars.submissions-sidebar',
            'StatusBadge' => 'atoms.utility.status-badge',
            'StatusDot' => 'atoms.utility.status-dot',
            'DigitalClock' => 'atoms.utility.digital-clock',
            'StudentGroup' => 'atoms.buttons.action-buttons.student-group',
            'UserGroup' => 'atoms.buttons.action-buttons.user-group',
            'AppointmentGroup' => 'atoms.buttons.action-buttons.appointment-group',
            'UserProfileForm' => 'molecules.forms.user-profile-form',
            'UserAvatar' => 'atoms.images.user-avatar',
            'OTPPage' => 'layouts.otp-page',
        ];

        foreach ($components as $class => $alias) {
            $componentPath = str($class)->startsWith('\\') ? '' : 'App\\Components\\';
            $className = str($class)->ltrim('\\')->toString();
            Blade::component("{$componentPath}{$className}", $alias);
        }

        View::composer('profile', fn ($view) => $view->with('user', auth()->user()));

        View::share(['status' => 'Active', 'theme' => 'dark']);

        View::composer('*', function ($view) {
            if (!View::shared('bladeViewName')) {
                View::share('bladeViewName', $view->getName());
            }
        });
    }
}
