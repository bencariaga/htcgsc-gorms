# HTCGSC-GORMS File Directory Map

```text
htcgsc-gorms/
├─ app/
│  ├─ Actions/
│  │  ├─ Appointment/
│  │  │  ├─ CancelAppointment.php
│  │  │  ├─ CompleteAppointment.php
│  │  │  ├─ FilterAppointments.php
│  │  │  ├─ MarkMissedAppointments.php
│  │  │  ├─ RescheduleAppointment.php
│  │  │  ├─ SearchAppointments.php
│  │  │  └─ UpdateNewDate.php
│  │  ├─ AuditLog/
│  │  │  ├─ ClearAuditLogData.php
│  │  │  ├─ DownloadAuditLog.php
│  │  │  ├─ FilterAuditLogs.php
│  │  │  ├─ GetAuditLogs.php
│  │  │  ├─ GetMarkdownAuditLog.php
│  │  │  ├─ GetPlainTextAuditLog.php
│  │  │  ├─ PrepareAuditLogData.php
│  │  │  ├─ SearchAuditLogs.php
│  │  │  └─ SortAuditLogs.php
│  │  ├─ Auth/
│  │  │  └─ LogoutUser.php
│  │  ├─ Dashboard/
│  │  │  ├─ RenderChartStatistics.php
│  │  │  └─ RenderTextStatistics.php
│  │  ├─ Data/
│  │  │  ├─ Statistics/
│  │  │  │  ├─ RenderAppointmentStatistics.php
│  │  │  │  ├─ RenderStudentStatistics.php
│  │  │  │  └─ RenderUserStatistics.php
│  │  │  ├─ GenerateDatabaseTableRowId.php
│  │  │  └─ RenderStatisticalData.php
│  │  ├─ GoogleForms/
│  │  │  ├─ Generators/
│  │  │  │  ├─ GenerateImageSubmission.php
│  │  │  │  ├─ GenerateLogSubmission.php
│  │  │  │  └─ GeneratePdfSubmission.php
│  │  │  ├─ DownloadSubmission.php
│  │  │  ├─ GetLogFiles.php
│  │  │  ├─ GetOrCreateEntity.php
│  │  │  ├─ GetSidebarStats.php
│  │  │  ├─ GetUrls.php
│  │  │  ├─ ProcessSubmission.php
│  │  │  └─ RenderSubmission.php
│  │  ├─ Mail/
│  │  │  ├─ SendAccountNoticeMail.php
│  │  │  ├─ SendAppointmentReminderMail.php
│  │  │  └─ SendOtpMail.php
│  │  ├─ OTP/
│  │  │  ├─ FindUserByIdentifier.php
│  │  │  ├─ GenerateAndSendOTP.php
│  │  │  └─ ValidateOTP.php
│  │  ├─ Person/
│  │  │  └─ UpdatePersonInfo.php
│  │  ├─ Profile/
│  │  │  ├─ HandleProfileUpdate.php
│  │  │  ├─ PrepareProfileUpdatedEvent.php
│  │  │  ├─ StorePendingProfileUpdate.php
│  │  │  ├─ UpdateUserProfile.php
│  │  │  └─ UpdateUserProfilePicture.php
│  │  ├─ QrCode/
│  │  │  ├─ DisplayQrCode.php
│  │  │  ├─ DownloadQrCode.php
│  │  │  ├─ GenerateQrCode.php
│  │  │  ├─ GetQrCodeActions.php
│  │  │  └─ GetQrCodeData.php
│  │  ├─ Report/
│  │  │  ├─ DeleteReport.php
│  │  │  ├─ DownloadReport.php
│  │  │  ├─ PrepareReportDownloadData.php
│  │  │  ├─ PrepareReportForm.php
│  │  │  ├─ RenderReport.php
│  │  │  └─ SaveReport.php
│  │  ├─ Student/
│  │  │  ├─ CreateStudent.php
│  │  │  ├─ FilterStudents.php
│  │  │  ├─ SearchStudents.php
│  │  │  └─ UpdateStudent.php
│  │  └─ User/
│  │     ├─ AuthenticateUser.php
│  │     ├─ DeleteUser.php
│  │     ├─ FilterUsers.php
│  │     ├─ RegisterUser.php
│  │     ├─ ResetUserPassword.php
│  │     ├─ SearchUsers.php
│  │     └─ UpdateUserStatus.php
│  ├─ Components/
│  │  ├─ Atoms/
│  │  │  ├─ Buttons/
│  │  │  │  ├─ ActionButtons/
│  │  │  │  │  ├─ AppointmentGroup.php
│  │  │  │  │  ├─ AuditLogGroup.php
│  │  │  │  │  ├─ StudentGroup.php
│  │  │  │  │  └─ UserGroup.php
│  │  │  │  ├─ ButtonGroups/
│  │  │  │  │  ├─ AuditLogButtonGroup.php
│  │  │  │  │  ├─ FilterButtonGroup.php
│  │  │  │  │  └─ PageButtonGroup.php
│  │  │  │  └─ ThemeToggler.php
│  │  │  ├─ Feedback/
│  │  │  │  └─ ValidationError.php
│  │  │  ├─ Forms/
│  │  │  │  ├─ FieldIcon.php
│  │  │  │  └─ FieldLabel.php
│  │  │  ├─ Images/
│  │  │  │  ├─ SystemLogo.php
│  │  │  │  └─ UserAvatar.php
│  │  │  ├─ Inputs/
│  │  │  │  └─ AuthInput.php
│  │  │  └─ Utility/
│  │  │     ├─ DigitalClock.php
│  │  │     ├─ Spinner.php
│  │  │     ├─ StatusBadge.php
│  │  │     └─ StatusDot.php
│  │  ├─ GoogleForms/
│  │  │  ├─ Base.php
│  │  │  └─ InfoSection.php
│  │  ├─ Layouts/
│  │  │  ├─ NoticeEmail.php
│  │  │  ├─ OtpEmail.php
│  │  │  └─ OtpPage.php
│  │  ├─ Molecules/
│  │  │  ├─ Forms/
│  │  │  │  ├─ AuthForm.php
│  │  │  │  ├─ FormFooter.php
│  │  │  │  ├─ FormHeader.php
│  │  │  │  ├─ GoogleForm.php
│  │  │  │  ├─ ProfileActionBar.php
│  │  │  │  ├─ ProfilePhotoEditor.php
│  │  │  │  ├─ ReportForm.php
│  │  │  │  ├─ StudentProfileForm.php
│  │  │  │  ├─ SuffixDropdown.php
│  │  │  │  └─ UserProfileForm.php
│  │  │  ├─ LoadingScreens/
│  │  │  │  ├─ Ls.php
│  │  │  │  ├─ LsAuth.php
│  │  │  │  ├─ LsListType.php
│  │  │  │  ├─ LsLivewire.php
│  │  │  │  └─ TemplateLs.php
│  │  │  ├─ Modals/
│  │  │  │  ├─ AuditLogMessageModal.php
│  │  │  │  ├─ ConfirmationModal.php
│  │  │  │  ├─ RescheduleAppointmentModal.php
│  │  │  │  └─ UserPasswordModal.php
│  │  │  ├─ Sidebars/
│  │  │  │  ├─ AuditLogsSidebar.php
│  │  │  │  ├─ ReportsSidebar.php
│  │  │  │  ├─ SubmissionsSidebar.php
│  │  │  │  └─ TemplateSidebar.php
│  │  │  └─ ToastNotifications/
│  │  │     ├─ TemplateTn.php
│  │  │     ├─ Tn.php
│  │  │     └─ TnAuth.php
│  │  ├─ Organisms/
│  │  │  ├─ Layouts/
│  │  │  │  ├─ Footer.php
│  │  │  │  ├─ Header.php
│  │  │  │  └─ Sidebar.php
│  │  │  ├─ Main/
│  │  │  │  └─ SubmissionsBody.php
│  │  │  ├─ Navigation/
│  │  │  │  ├─ Pagination.php
│  │  │  │  ├─ PaginationGroup.php
│  │  │  │  ├─ PaginationResults.php
│  │  │  │  ├─ RowsPerPage.php
│  │  │  │  ├─ Search.php
│  │  │  │  └─ Sort.php
│  │  │  └─ Tables/
│  │  │     ├─ Columns/
│  │  │     │  ├─ Appointment.php
│  │  │     │  ├─ AuditLog.php
│  │  │     │  ├─ Student.php
│  │  │     │  └─ User.php
│  │  │     ├─ Rows/
│  │  │     │  ├─ Appointment.php
│  │  │     │  ├─ AuditLog.php
│  │  │     │  ├─ Student.php
│  │  │     │  └─ User.php
│  │  │     ├─ EmptyState.php
│  │  │     ├─ InfiniteScrollLoader.php
│  │  │     ├─ Table.php
│  │  │     ├─ TableColumn.php
│  │  │     └─ TableRow.php
│  │  ├─ Pages/
│  │  │  └─ ListType.php
│  │  ├─ Reports/
│  │  │  └─ Base.php
│  │  └─ Templates/
│  │     ├─ AuthenticationPages.php
│  │     └─ PersonalPages.php
│  ├─ Console/
│  │  ├─ Commands/
│  │  │  ├─ BaseCommand.php
│  │  │  ├─ CleanLivewireTemp.php
│  │  │  ├─ DebugbarClear.php
│  │  │  ├─ EnvCheck.php
│  │  │  ├─ EnvRepair.php
│  │  │  ├─ GenerateObservers.php
│  │  │  ├─ IdeHelperRepair.php
│  │  │  ├─ InternetCheck.php
│  │  │  ├─ LogsClear.php
│  │  │  ├─ PestControl.php
│  │  │  ├─ Setup.php
│  │  │  ├─ StorageUnlink.php
│  │  │  ├─ SystemOptimize.php
│  │  │  ├─ SystemRefresh.php
│  │  │  ├─ SystemRepair.php
│  │  │  └─ VendorWarningAndErrorSilence.php
│  │  └─ Kernel.php
│  ├─ Contracts/
│  │  ├─ AppointmentServiceContract.php
│  │  ├─ AuthenticatesUser.php
│  │  ├─ Colorable.php
│  │  ├─ CommonModel.php
│  │  ├─ DeletesUsers.php
│  │  ├─ HandlesAppointmentEvents.php
│  │  ├─ HandlesPersonEvents.php
│  │  ├─ HandlesReferralEvents.php
│  │  ├─ HandlesReferrerEvents.php
│  │  ├─ HandlesReportEvents.php
│  │  ├─ HandlesStudentEvents.php
│  │  ├─ HandlesUserEvents.php
│  │  ├─ Nameable.php
│  │  ├─ RegistersUser.php
│  │  ├─ ResetsUserPassword.php
│  │  ├─ SearchsAppointments.php
│  │  ├─ SearchsStudents.php
│  │  ├─ SearchsUsers.php
│  │  └─ UpdatesUserStatus.php
│  ├─ Data/
│  │  ├─ AppointmentData.php
│  │  ├─ AppointmentRescheduleData.php
│  │  ├─ AuthenticateUserData.php
│  │  ├─ PasswordResetData.php
│  │  ├─ PersonData.php
│  │  ├─ ReferralData.php
│  │  ├─ ReferrerData.php
│  │  ├─ ReportData.php
│  │  ├─ StudentData.php
│  │  ├─ UserData.php
│  │  ├─ UserRegistrationData.php
│  │  └─ UserStatusData.php
│  ├─ Enums/
│  │  ├─ NonDB/
│  │  │  ├─ AuditLogsStyling.php
│  │  │  ├─ AuthenticationStyling.php
│  │  │  ├─ DashboardStyling.php
│  │  │  ├─ EmailAndPageOTP.php
│  │  │  ├─ EmailNotice.php
│  │  │  ├─ Exceptions.php
│  │  │  ├─ GoogleFormsStyling.php
│  │  │  ├─ ListTypeModals.php
│  │  │  ├─ NonDBEnums.php
│  │  │  ├─ PageButtonStyling.php
│  │  │  ├─ PaginationStyling.php
│  │  │  ├─ PhilippineHolidays.php
│  │  │  ├─ ProfileFormStyling.php
│  │  │  ├─ QrCodeStyling.php
│  │  │  ├─ ReportDownloadDataStyling.php
│  │  │  ├─ ReportFormStyling.php
│  │  │  └─ SubmissionsStyling.php
│  │  ├─ AccountStatus.php
│  │  ├─ AppointmentStatus.php
│  │  ├─ AppointmentTime.php
│  │  ├─ DataCategory.php
│  │  ├─ Enums.php
│  │  ├─ FileOutputFormat.php
│  │  ├─ PersonSuffix.php
│  │  ├─ PersonType.php
│  │  └─ ReferralType.php
│  ├─ Exceptions/
│  │  ├─ FalsePositiveException.php
│  │  ├─ Handler.php
│  │  ├─ NoInternetConnectionException.php
│  │  └─ NullException.php
│  ├─ Exports/
│  │  ├─ Components/
│  │  │  ├─ Arrays.php
│  │  │  ├─ Headings.php
│  │  │  ├─ Styles.php
│  │  │  └─ Title.php
│  │  ├─ Report/
│  │  │  └─ Format.php
│  │  └─ ReportTypes/
│  │     ├─ FormSubmissions.php
│  │     ├─ Students.php
│  │     └─ Users.php
│  ├─ Http/
│  │  ├─ Controllers/
│  │  │  ├─ Controller.php
│  │  │  ├─ GoogleFormController.php
│  │  │  ├─ SchedulerController.php
│  │  │  ├─ StudentProfileController.php
│  │  │  ├─ SystemController.php
│  │  │  └─ UserProfileController.php
│  │  ├─ Middleware/
│  │  │  ├─ CheckSystemConfiguration.php
│  │  │  ├─ RedirectIfAuthenticated.php
│  │  │  └─ UpdateLastActivity.php
│  │  └─ Requests/
│  │     ├─ GoogleFormRequest.php
│  │     ├─ SendOneTimePassword.php
│  │     ├─ UpdateAppointmentTime.php
│  │     ├─ UpdateStudentProfile.php
│  │     ├─ UpdateUserPassword.php
│  │     └─ UpdateUserProfile.php
│  ├─ Livewire/
│  │  ├─ Authentication/
│  │  │  ├─ CreateAccount.php
│  │  │  ├─ ForgotPassword.php
│  │  │  ├─ Login.php
│  │  │  ├─ OneTimePasswordEAC.php
│  │  │  ├─ OneTimePasswordLogin.php
│  │  │  └─ OneTimePasswordPNC.php
│  │  ├─ Bases/
│  │  │  ├─ BaseListType.php
│  │  │  └─ BaseOTPType.php
│  │  ├─ Components/
│  │  │  ├─ StudentProfileModal.php
│  │  │  └─ UserProfileModal.php
│  │  ├─ Forms/
│  │  │  ├─ LoginForm.php
│  │  │  ├─ PasswordChangeForm.php
│  │  │  ├─ RegisterForm.php
│  │  │  ├─ StudentProfileForm.php
│  │  │  └─ UserProfileForm.php
│  │  └─ Pages/
│  │     ├─ Appointments.php
│  │     ├─ AuditLogs.php
│  │     ├─ Dashboard.php
│  │     ├─ QrCode.php
│  │     ├─ Reports.php
│  │     ├─ Students.php
│  │     ├─ Submissions.php
│  │     ├─ UserProfile.php
│  │     └─ Users.php
│  ├─ Mail/
│  │  ├─ BaseMailable.php
│  │  ├─ NoticeAccountActivation.php
│  │  ├─ NoticeAccountDeactivation.php
│  │  ├─ NoticeAccountDeletion.php
│  │  ├─ NoticeReferralAppointment.php
│  │  ├─ OTPEmailAddressChange.php
│  │  └─ OTPLogin.php
│  ├─ Models/
│  │  ├─ Appointment.php
│  │  ├─ Person.php
│  │  ├─ Referral.php
│  │  ├─ Referrer.php
│  │  ├─ Report.php
│  │  ├─ Student.php
│  │  └─ User.php
│  ├─ Observers/
│  │  ├─ AppointmentObserver.php
│  │  ├─ PersonObserver.php
│  │  ├─ ReferralObserver.php
│  │  ├─ ReferrerObserver.php
│  │  ├─ ReportObserver.php
│  │  ├─ StudentObserver.php
│  │  └─ UserObserver.php
│  ├─ Policies/
│  │  └─ UserPolicy.php
│  ├─ Providers/
│  │  ├─ AppServiceProvider.php
│  │  ├─ AppSettingsServiceProvider.php
│  │  ├─ DatabaseServiceProvider.php
│  │  ├─ LoggingServiceProvider.php
│  │  ├─ MailServiceProvider.php
│  │  ├─ ObserverServiceProvider.php
│  │  ├─ RouteServiceProvider.php
│  │  └─ ViewServiceProvider.php
│  ├─ Rules/
│  │  ├─ AppointmentScheduler.php
│  │  ├─ DuplicateContactDetails.php
│  │  ├─ EmailAddressFormat.php
│  │  ├─ InternetConnection.php
│  │  ├─ MatchesCurrentFullName.php
│  │  ├─ OneTimePassword.php
│  │  ├─ PhoneNumberFormat.php
│  │  ├─ UserAuthentication.php
│  │  └─ UserPassword.php
│  ├─ Sanitizers/
│  │  ├─ AppointmentScheduler.php
│  │  ├─ DateRangeLimiter.php
│  │  ├─ DuplicateContactDetails.php
│  │  ├─ EmailAddressFormat.php
│  │  ├─ FuzzyNameMatch.php
│  │  ├─ FuzzyProfanityWordMatch.php
│  │  ├─ LanguageSanitizer.php
│  │  ├─ MatchesCurrentFullName.php
│  │  ├─ NameSanitizer.php
│  │  ├─ PhoneNumberFormat.php
│  │  └─ ReferralTypeIntegrity.php
│  ├─ Services/
│  │  ├─ ListType/
│  │  │  ├─ AppointmentService.php
│  │  │  ├─ AuditLogService.php
│  │  │  ├─ DataFilteringService.php
│  │  │  ├─ StudentService.php
│  │  │  └─ UserService.php
│  │  └─ Miscellaneous/
│  │     ├─ DashboardService.php
│  │     ├─ GoogleFormService.php
│  │     ├─ MailService.php
│  │     ├─ OTPService.php
│  │     ├─ ProfileService.php
│  │     ├─ QrCodeService.php
│  │     ├─ ReportService.php
│  │     ├─ SanitizationService.php
│  │     └─ TextBeeService.php
│  ├─ Support/
│  │  ├─ EagerLimit/
│  │  │  ├─ src/
│  │  │  │  ├─ Grammars/
│  │  │  │  │  ├─ Traits/
│  │  │  │  │  │  ├─ CompilesGroupLimit.php
│  │  │  │  │  │  ├─ CompilesMySqlGroupLimit.php
│  │  │  │  │  │  ├─ CompilesPostgresGroupLimit.php
│  │  │  │  │  │  ├─ CompilesSQLiteGroupLimit.php
│  │  │  │  │  │  └─ CompilesSqlServerGroupLimit.php
│  │  │  │  │  ├─ MySqlGrammar.php
│  │  │  │  │  ├─ PostgresGrammar.php
│  │  │  │  │  ├─ SQLiteGrammar.php
│  │  │  │  │  └─ SqlServerGrammar.php
│  │  │  │  ├─ Relations/
│  │  │  │  │  ├─ BelongsOrMorphToMany.php
│  │  │  │  │  ├─ BelongsToMany.php
│  │  │  │  │  ├─ HasLimit.php
│  │  │  │  │  ├─ HasMany.php
│  │  │  │  │  ├─ HasManyThrough.php
│  │  │  │  │  ├─ HasOne.php
│  │  │  │  │  ├─ HasOneOrManyThrough.php
│  │  │  │  │  ├─ HasOneThrough.php
│  │  │  │  │  ├─ MorphMany.php
│  │  │  │  │  ├─ MorphOne.php
│  │  │  │  │  └─ MorphToMany.php
│  │  │  │  ├─ Traits/
│  │  │  │  │  ├─ BuildsGroupLimitQueries.php
│  │  │  │  │  └─ HasEagerLimitRelationships.php
│  │  │  │  ├─ Builder.php
│  │  │  │  └─ HasEagerLimit.php
│  │  │  ├─ composer.json
│  │  │  ├─ LICENSE
│  │  │  └─ README.md
│  │  ├─ Formatters/
│  │  │  ├─ ExceptionLogFormatter.php
│  │  │  ├─ StandardLogFormatter.php
│  │  │  └─ StringLogFormatter.php
│  │  ├─ AppKeyChecker.php
│  │  ├─ BinaryFinder.php
│  │  ├─ HolidayClientCustom.php
│  │  ├─ Json.php
│  │  ├─ LevenshteinAlgorithm.php
│  │  ├─ Log.php
│  │  ├─ LogToMarkdownConverter.php
│  │  ├─ MarkdownToHtmlConverter.php
│  │  ├─ Regex.php
│  │  ├─ ScunthorpeProblemSolver.php
│  │  ├─ TimeZoneConverter.php
│  │  └─ VerticalFormatter.php
│  └─ Traits/
│     ├─ Handles/
│     │  ├─ HandlesAppointmentActions.php
│     │  ├─ HandlesAuditLogActions.php
│     │  ├─ HandlesBrowsershot.php
│     │  ├─ HandlesOTP.php
│     │  ├─ HandlesPostActionNotifications.php
│     │  ├─ HandlesStatistics.php
│     │  ├─ HandlesStudentActions.php
│     │  └─ HandlesUserActions.php
│     ├─ Has/
│     │  ├─ HasAppInformation.php
│     │  ├─ HasFormattedId.php
│     │  ├─ HasNameAttributes.php
│     │  ├─ HasProfanityList.php
│     │  └─ HasValues.php
│     ├─ Miscellaneous/
│     │  ├─ BaseCommandTrait.php
│     │  ├─ IsCommonModel.php
│     │  ├─ ManagesTransactions.php
│     │  ├─ ProvidesMessages.php
│     │  ├─ RendersQRCode.php
│     │  └─ Searchable.php
│     └─ Sets/
│        ├─ SetsDefaultStatus.php
│        └─ SetsHighPriority.php
├─ bootstrap/
│  ├─ app.php
│  └─ providers.php
├─ config/
│  ├─ app.php
│  ├─ auth.php
│  ├─ browsershot.php
│  ├─ cache.php
│  ├─ cors.php
│  ├─ database.php
│  ├─ debugbar.php
│  ├─ filesystems.php
│  ├─ holidays.php
│  ├─ ide-helper.php
│  ├─ livewire.php
│  ├─ log-viewer.php
│  ├─ logging.php
│  ├─ mail.php
│  ├─ octane.php
│  ├─ profanity.php
│  ├─ querydetector.php
│  ├─ queue.php
│  ├─ services.php
│  └─ session.php
├─ database/
│  ├─ factories/
│  │  ├─ AppointmentFactory.php
│  │  ├─ PersonFactory.php
│  │  ├─ ReferralFactory.php
│  │  ├─ ReferrerFactory.php
│  │  ├─ StudentFactory.php
│  │  └─ UserFactory.php
│  ├─ migrations/
│  │  ├─ laravel/
│  │  │  ├─ create_cache_locks_table.php
│  │  │  ├─ create_cache_table.php
│  │  │  ├─ create_failed_jobs_table.php
│  │  │  ├─ create_job_batches_table.php
│  │  │  ├─ create_jobs_table.php
│  │  │  └─ create_sessions_table.php
│  │  └─ system/
│  │     ├─ 01_create_persons_table.php
│  │     ├─ 02_create_students_table.php
│  │     ├─ 03_create_users_table.php
│  │     ├─ 04_create_referrers_table.php
│  │     ├─ 05_create_referrals_table.php
│  │     ├─ 06_create_appointments_table.php
│  │     ├─ 07_create_reports_table.php
│  │     └─ 08_create_all_activities_view.php
│  ├─ seeders/
│  │  ├─ AppointmentSeeder.php
│  │  ├─ DatabaseSeeder.php
│  │  ├─ ReportSeeder.php
│  │  ├─ StudentSeeder.php
│  │  └─ UserSeeder.php
│  ├─ special_scripts/
│  │  ├─ add_auto_increment.php
│  │  ├─ empty_database.php
│  │  ├─ empty_db_except_admin.php
│  │  ├─ nuke_database.php
│  │  ├─ nuke_db_if_db_exists.php
│  │  ├─ randomize_timestamps.php
│  │  └─ remove_auto_increment.php
│  ├─ .gitignore
│  └─ testing.sqlite
├─ docker/
│  └─ nginx.conf
├─ markdown/
│  ├─ CONTEXT.md
│  ├─ DIRECTORIES.md
│  ├─ DOCKER.md
│  ├─ INSTRUCTIONS.md
│  ├─ LARAVEL_BEST_PRACTICES.md
│  ├─ llms-full.txt
│  ├─ NGROK.md
│  ├─ RENDER.md
│  ├─ SCHEMA.md
│  ├─ SETUP.md
│  ├─ TESTING.md
│  ├─ TEXTBEE.md
│  └─ XAMPP.md
├─ public/
│  ├─ css/
│  │  ├─ authentication-pages.css
│  │  └─ personal-pages.css
│  ├─ images/
│  │  ├─ google-forms.png
│  │  ├─ HTCGSC-campus.png
│  │  ├─ HTCGSC-GORMS-logo-white.png
│  │  └─ HTCGSC-GORMS-logo.png
│  ├─ js/
│  │  ├─ appointments.js
│  │  ├─ audit-logs.js
│  │  ├─ global.js
│  │  ├─ list-type.js
│  │  ├─ otp-page.js
│  │  ├─ qr-code.js
│  │  ├─ reports.js
│  │  ├─ session-flash.js
│  │  ├─ student-profile.js
│  │  ├─ submissions.js
│  │  ├─ tailwind-config.js
│  │  ├─ theme-init.js
│  │  └─ user-profile.js
│  ├─ .htaccess
│  ├─ index.php
│  └─ robots.txt
├─ resources/
│  ├─ css/
│  │  └─ app.css
│  ├─ js/
│  │  └─ app.js
│  └─ views/
│     ├─ components/
│     │  ├─ atoms/
│     │  │  ├─ buttons/
│     │  │  │  ├─ action-buttons/
│     │  │  │  │  ├─ appointment-group.blade.php
│     │  │  │  │  ├─ audit-log-group.blade.php
│     │  │  │  │  ├─ student-group.blade.php
│     │  │  │  │  └─ user-group.blade.php
│     │  │  │  ├─ button-groups/
│     │  │  │  │  ├─ audit-log-button-group.blade.php
│     │  │  │  │  ├─ filter-button-group.blade.php
│     │  │  │  │  └─ page-button-group.blade.php
│     │  │  │  └─ theme-toggler.blade.php
│     │  │  ├─ feedback/
│     │  │  │  └─ validation-error.blade.php
│     │  │  ├─ forms/
│     │  │  │  ├─ field-icon.blade.php
│     │  │  │  └─ field-label.blade.php
│     │  │  ├─ images/
│     │  │  │  ├─ system-logo.blade.php
│     │  │  │  └─ user-avatar.blade.php
│     │  │  ├─ inputs/
│     │  │  │  └─ auth-input.blade.php
│     │  │  └─ utility/
│     │  │     ├─ digital-clock.blade.php
│     │  │     ├─ spinner.blade.php
│     │  │     ├─ status-badge.blade.php
│     │  │     └─ status-dot.blade.php
│     │  ├─ google-forms/
│     │  │  ├─ base.blade.php
│     │  │  ├─ image.blade.php
│     │  │  ├─ info-section.blade.php
│     │  │  └─ pdf.blade.php
│     │  ├─ layouts/
│     │  │  ├─ notice-email.blade.php
│     │  │  ├─ otp-email.blade.php
│     │  │  └─ otp-page.blade.php
│     │  ├─ molecules/
│     │  │  ├─ data-display/
│     │  │  │  ├─ line-chart.blade.php
│     │  │  │  ├─ qr-code-display.blade.php
│     │  │  │  └─ statistics-card.blade.php
│     │  │  ├─ forms/
│     │  │  │  ├─ auth-form.blade.php
│     │  │  │  ├─ form-footer.blade.php
│     │  │  │  ├─ form-header.blade.php
│     │  │  │  ├─ google-form.blade.php
│     │  │  │  ├─ profile-action-bar.blade.php
│     │  │  │  ├─ profile-photo-editor.blade.php
│     │  │  │  ├─ report-form.blade.php
│     │  │  │  ├─ student-profile-form.blade.php
│     │  │  │  ├─ suffix-dropdown.blade.php
│     │  │  │  └─ user-profile-form.blade.php
│     │  │  ├─ loading-screens/
│     │  │  │  ├─ ls-auth.blade.php
│     │  │  │  ├─ ls-list-type.blade.php
│     │  │  │  ├─ ls-livewire.blade.php
│     │  │  │  ├─ ls.blade.php
│     │  │  │  └─ template-ls.blade.php
│     │  │  ├─ modals/
│     │  │  │  ├─ audit-log-message-modal.blade.php
│     │  │  │  ├─ confirmation-modal.blade.php
│     │  │  │  ├─ reschedule-appointment-modal.blade.php
│     │  │  │  └─ user-password-modal.blade.php
│     │  │  ├─ navigation/
│     │  │  │  └─ qr-code-actions.blade.php
│     │  │  ├─ sidebars/
│     │  │  │  ├─ audit-logs-sidebar.blade.php
│     │  │  │  ├─ reports-sidebar.blade.php
│     │  │  │  ├─ submissions-sidebar.blade.php
│     │  │  │  └─ template-sidebar.blade.php
│     │  │  └─ toast-notifications/
│     │  │     ├─ template-tn.blade.php
│     │  │     ├─ tn-auth.blade.php
│     │  │     └─ tn.blade.php
│     │  ├─ organisms/
│     │  │  ├─ layouts/
│     │  │  │  ├─ footer.blade.php
│     │  │  │  ├─ header.blade.php
│     │  │  │  └─ sidebar.blade.php
│     │  │  ├─ main/
│     │  │  │  └─ submissions-body.blade.php
│     │  │  ├─ navigation/
│     │  │  │  ├─ pagination-group.blade.php
│     │  │  │  ├─ pagination-results.blade.php
│     │  │  │  ├─ pagination.blade.php
│     │  │  │  ├─ rows-per-page.blade.php
│     │  │  │  ├─ search.blade.php
│     │  │  │  └─ sort.blade.php
│     │  │  └─ tables/
│     │  │     ├─ columns/
│     │  │     │  ├─ appointment.blade.php
│     │  │     │  ├─ audit-log.blade.php
│     │  │     │  ├─ student.blade.php
│     │  │     │  └─ user.blade.php
│     │  │     ├─ rows/
│     │  │     │  ├─ appointment.blade.php
│     │  │     │  ├─ audit-log.blade.php
│     │  │     │  ├─ student.blade.php
│     │  │     │  └─ user.blade.php
│     │  │     ├─ empty-state.blade.php
│     │  │     ├─ infinite-scroll-loader.blade.php
│     │  │     ├─ table-column.blade.php
│     │  │     ├─ table-row.blade.php
│     │  │     └─ table.blade.php
│     │  ├─ pages/
│     │  │  └─ list-type.blade.php
│     │  └─ reports/
│     │     ├─ base.blade.php
│     │     ├─ form-submissions.blade.php
│     │     ├─ students.blade.php
│     │     └─ users.blade.php
│     ├─ emails/
│     │  ├─ notice-account-activation.blade.php
│     │  ├─ notice-account-deactivation.blade.php
│     │  ├─ notice-account-deletion.blade.php
│     │  ├─ notice-referral-appointment.blade.php
│     │  ├─ otp-email-address-change.blade.php
│     │  └─ otp-login.blade.php
│     ├─ errors/
│     │  ├─ 400.blade.php
│     │  ├─ 401.blade.php
│     │  ├─ 403.blade.php
│     │  ├─ 404.blade.php
│     │  ├─ 405.blade.php
│     │  ├─ 406.blade.php
│     │  ├─ 407.blade.php
│     │  ├─ 408.blade.php
│     │  ├─ 409.blade.php
│     │  ├─ 410.blade.php
│     │  ├─ 411.blade.php
│     │  ├─ 412.blade.php
│     │  ├─ 413.blade.php
│     │  ├─ 414.blade.php
│     │  ├─ 415.blade.php
│     │  ├─ 416.blade.php
│     │  ├─ 417.blade.php
│     │  ├─ 419.blade.php
│     │  ├─ 421.blade.php
│     │  ├─ 422.blade.php
│     │  ├─ 423.blade.php
│     │  ├─ 425.blade.php
│     │  ├─ 426.blade.php
│     │  ├─ 428.blade.php
│     │  ├─ 429.blade.php
│     │  ├─ 431.blade.php
│     │  ├─ 500.blade.php
│     │  ├─ 501.blade.php
│     │  ├─ 502.blade.php
│     │  ├─ 503.blade.php
│     │  ├─ 504.blade.php
│     │  └─ errors.blade.php
│     ├─ layouts/
│     │  ├─ authentication-pages.blade.php
│     │  └─ personal-pages.blade.php
│     └─ livewire/
│        ├─ authentication/
│        │  ├─ create-account.blade.php
│        │  ├─ forgot-password.blade.php
│        │  ├─ login.blade.php
│        │  ├─ one-time-password-eac.blade.php
│        │  ├─ one-time-password-login.blade.php
│        │  └─ one-time-password-pnc.blade.php
│        ├─ components/
│        │  ├─ student-profile-modal.blade.php
│        │  └─ user-profile-modal.blade.php
│        └─ pages/
│           ├─ appointments.blade.php
│           ├─ audit-logs.blade.php
│           ├─ dashboard.blade.php
│           ├─ qr-code.blade.php
│           ├─ reports.blade.php
│           ├─ students.blade.php
│           ├─ submissions.blade.php
│           ├─ user-profile.blade.php
│           └─ users.blade.php
├─ routes/
│  ├─ api.php
│  ├─ auth.php
│  ├─ console.php
│  ├─ livewire.php
│  ├─ miscellaneous.php
│  └─ web.php
├─ storage/
│  ├─ app/
│  │  ├─ browsershot-cache/
│  │  ├─ private/
│  │  │  ├─ livewire-tmp/
│  │  │  └─ .gitignore
│  │  ├─ public/
│  │  │  ├─ profile-pictures/
│  │  │  │  └─ *.jpg
│  │  │  └─ .gitignore
│  │  └─ .gitignore
│  ├─ debugbar/
│  ├─ framework/
│  └─ logs/
│     ├─ google-forms/
│     │  └─ google-forms-YYYY-MM-DD.log
│     ├─ .gitignore
│     └─ laravel-YYYY-MM-DD.log
├─ tests/
│  ├─ Browser/
│  │  ├─ console/
│  │  ├─ screenshots/
│  │  ├─ appointments.spec.js
│  │  ├─ reports.spec.js
│  │  ├─ students.spec.js
│  │  └─ users.spec.js
│  ├─ Feature/
│  │  ├─ Browser/
│  │  │  ├─ AppointmentCrudTest.php
│  │  │  ├─ AuditLogsTest.php
│  │  │  ├─ DashboardTest.php
│  │  │  ├─ ReportCrudTest.php
│  │  │  ├─ StudentCrudTest.php
│  │  │  ├─ SubmissionsTest.php
│  │  │  ├─ UserCrudTest.php
│  │  │  └─ UserProfileTest.php
│  │  └─ Logic/
│  │     ├─ AuthenticationTest.php
│  │     └─ ModelTest.php
│  ├─ Unit/
│  ├─ DuskTestCase.php
│  ├─ Pest.php
│  ├─ TestCase.php
│  └─ UnitTestCase.php
├─ _ide_helper_models.php
├─ _ide_helper.php
├─ .dockerignore
├─ .editorconfig
├─ .env
├─ .env.example
├─ .gitattributes
├─ .gitignore
├─ .markdownlint.json
├─ .prettierrc
├─ artisan
├─ compose.debug.yaml
├─ compose.yaml
├─ composer.json
├─ composer.lock
├─ Dockerfile
├─ htcgsc_gorms.sql
├─ jsconfig.json
├─ package-lock.json
├─ package.json
├─ phpunit.dusk.xml
├─ phpunit.xml
├─ pint.json
├─ playwright.config.js
├─ README.md
├─ render.yaml
├─ tailwind.config.js
├─ vite.config.js
└─ vitest.config.js
```
