<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $appointment_id
 * @property int $referrer_id
 * @property int $referral_id
 * @property ReferralType $referral_type
 * @property string $reason
 * @property DateTimeImmutable $appointment_date
 * @property AppointmentTime $appointment_time
 * @property AppointmentStatus $appointment_status
 * @property DateTimeImmutable $created_at
 * @property DateTimeImmutable $updated_at
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Appointment> $children
 * @property-read int|null $children_count
 * @property-read string $formatted_appointment_id
 * @property-read string $formatted_id
 * @property-read \App\Models\Appointment|null $parent
 * @property-read \App\Models\Referral $referral
 * @property-read \App\Models\Referrer $referrer
 * @property-read int $depth
 * @property-read string $path
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Appointment> $ancestors The model's recursive parents.
 * @property-read int|null $ancestors_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Appointment> $ancestorsAndSelf The model's recursive parents and itself.
 * @property-read int|null $ancestors_and_self_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Appointment> $bloodline The model's ancestors, descendants and itself.
 * @property-read int|null $bloodline_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Appointment> $childrenAndSelf The model's direct children and itself.
 * @property-read int|null $children_and_self_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Appointment> $descendants The model's recursive children.
 * @property-read int|null $descendants_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Appointment> $descendantsAndSelf The model's recursive children and itself.
 * @property-read int|null $descendants_and_self_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Appointment> $parentAndSelf The model's direct parent and itself.
 * @property-read int|null $parent_and_self_count
 * @property-read \App\Models\Appointment|null $rootAncestor The model's topmost parent.
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Appointment> $siblings The parent's other children.
 * @property-read int|null $siblings_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Appointment> $siblingsAndSelf All the parent's children.
 * @property-read int|null $siblings_and_self_count
 * @property-read \App\Models\Student|null $student
 * @property-read \App\Models\Person|null $person
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> all($columns = ['*'])
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Appointment breadthFirst()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Appointment depthFirst()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Appointment doesntHaveChildren()
 * @method static \Database\Factories\AppointmentFactory factory($count = null, $state = [])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> get($columns = ['*'])
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Appointment getExpressionGrammar()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Appointment hasChildren()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Appointment hasParent()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Appointment isLeaf()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Appointment isRoot()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Appointment newModelQuery()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Appointment newQuery()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Appointment query()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Appointment tree($maxDepth = null)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Appointment treeOf(\Illuminate\Database\Eloquent\Model|callable $constraint, $maxDepth = null)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Appointment whereAppointmentDate($value)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Appointment whereAppointmentId($value)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Appointment whereAppointmentStatus($value)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Appointment whereAppointmentTime($value)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Appointment whereCreatedAt($value)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Appointment whereDepth($operator, $value = null)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Appointment whereReason($value)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Appointment whereReferralId($value)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Appointment whereReferralType($value)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Appointment whereReferrerId($value)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Appointment whereUpdatedAt($value)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Appointment withGlobalScopes(array $scopes)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Appointment withRelationshipExpression($direction, callable $constraint, $initialDepth, $from = null, $maxDepth = null)
 */
	class Appointment extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $person_id
 * @property int $referral_id
 * @property string $last_name
 * @property string $first_name
 * @property string|null $middle_name
 * @property string $email_address
 * @property string $phone_number
 * @property PersonSuffix|null $suffix
 * @property PersonType $type
 * @property DateTimeImmutable $created_at
 * @property DateTimeImmutable $updated_at
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Person> $children
 * @property-read int|null $children_count
 * @property-read mixed $formal_name
 * @property-read mixed $formal_name_with_initial
 * @property-read mixed $full_name
 * @property-read mixed $full_name_with_initial
 * @property-read \App\Models\Person|null $parent
 * @property-read \App\Models\Student|null $student
 * @property-read \App\Models\User|null $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Student[] $allStudentActivities
 * @property-read int|null $all_student_activities_count
 * @property-read int $depth
 * @property-read string $path
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Person> $ancestors The model's recursive parents.
 * @property-read int|null $ancestors_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Person> $ancestorsAndSelf The model's recursive parents and itself.
 * @property-read int|null $ancestors_and_self_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Person> $bloodline The model's ancestors, descendants and itself.
 * @property-read int|null $bloodline_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Person> $childrenAndSelf The model's direct children and itself.
 * @property-read int|null $children_and_self_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Person> $descendants The model's recursive children.
 * @property-read int|null $descendants_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Person> $descendantsAndSelf The model's recursive children and itself.
 * @property-read int|null $descendants_and_self_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Person> $parentAndSelf The model's direct parent and itself.
 * @property-read int|null $parent_and_self_count
 * @property-read \App\Models\Person|null $rootAncestor The model's topmost parent.
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Person> $siblings The parent's other children.
 * @property-read int|null $siblings_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Person> $siblingsAndSelf All the parent's children.
 * @property-read int|null $siblings_and_self_count
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> all($columns = ['*'])
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Person breadthFirst()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Person depthFirst()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Person doesntHaveChildren()
 * @method static \Database\Factories\PersonFactory factory($count = null, $state = [])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> get($columns = ['*'])
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Person getExpressionGrammar()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Person hasChildren()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Person hasParent()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Person isLeaf()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Person isRoot()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Person newModelQuery()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Person newQuery()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Person query()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Person tree($maxDepth = null)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Person treeOf(\Illuminate\Database\Eloquent\Model|callable $constraint, $maxDepth = null)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Person whereCreatedAt($value)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Person whereDepth($operator, $value = null)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Person whereEmailAddress($value)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Person whereFirstName($value)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Person whereLastName($value)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Person whereMiddleName($value)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Person wherePersonId($value)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Person wherePhoneNumber($value)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Person whereSuffix($value)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Person whereType($value)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Person whereUpdatedAt($value)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Person withGlobalScopes(array $scopes)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Person withRelationshipExpression($direction, callable $constraint, $initialDepth, $from = null, $maxDepth = null)
 */
	class Person extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $referral_id
 * @property int $student_id
 * @property string $reason
 * @property ReferralType $referral_type
 * @property DateTimeImmutable $created_at
 * @property DateTimeImmutable $updated_at
 * @property-read \App\Models\Appointment|null $appointment
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Referral> $children
 * @property-read int|null $children_count
 * @property-read \App\Models\Referral|null $parent
 * @property-read \App\Models\Student $student
 * @property-read int $depth
 * @property-read string $path
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Referral> $ancestors The model's recursive parents.
 * @property-read int|null $ancestors_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Referral> $ancestorsAndSelf The model's recursive parents and itself.
 * @property-read int|null $ancestors_and_self_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Referral> $bloodline The model's ancestors, descendants and itself.
 * @property-read int|null $bloodline_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Referral> $childrenAndSelf The model's direct children and itself.
 * @property-read int|null $children_and_self_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Referral> $descendants The model's recursive children.
 * @property-read int|null $descendants_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Referral> $descendantsAndSelf The model's recursive children and itself.
 * @property-read int|null $descendants_and_self_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Referral> $parentAndSelf The model's direct parent and itself.
 * @property-read int|null $parent_and_self_count
 * @property-read \App\Models\Referral|null $rootAncestor The model's topmost parent.
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Referral> $siblings The parent's other children.
 * @property-read int|null $siblings_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Referral> $siblingsAndSelf All the parent's children.
 * @property-read int|null $siblings_and_self_count
 * @property-read \App\Models\Person|null $person
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> all($columns = ['*'])
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Referral breadthFirst()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Referral depthFirst()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Referral doesntHaveChildren()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> get($columns = ['*'])
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Referral getExpressionGrammar()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Referral hasChildren()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Referral hasParent()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Referral isLeaf()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Referral isRoot()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Referral newModelQuery()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Referral newQuery()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Referral query()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Referral tree($maxDepth = null)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Referral treeOf(\Illuminate\Database\Eloquent\Model|callable $constraint, $maxDepth = null)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Referral whereCreatedAt($value)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Referral whereDepth($operator, $value = null)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Referral whereReferralId($value)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Referral whereStudentId($value)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Referral whereUpdatedAt($value)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Referral withGlobalScopes(array $scopes)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Referral withRelationshipExpression($direction, callable $constraint, $initialDepth, $from = null, $maxDepth = null)
 */
	class Referral extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $referrer_id
 * @property int $student_id
 * @property DateTimeImmutable $created_at
 * @property DateTimeImmutable $updated_at
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Appointment> $appointments
 * @property-read int|null $appointments_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Referrer> $children
 * @property-read int|null $children_count
 * @property-read \App\Models\Referrer|null $parent
 * @property-read \App\Models\Student $student
 * @property-read int $depth
 * @property-read string $path
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Referrer> $ancestors The model's recursive parents.
 * @property-read int|null $ancestors_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Referrer> $ancestorsAndSelf The model's recursive parents and itself.
 * @property-read int|null $ancestors_and_self_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Referrer> $bloodline The model's ancestors, descendants and itself.
 * @property-read int|null $bloodline_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Referrer> $childrenAndSelf The model's direct children and itself.
 * @property-read int|null $children_and_self_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Referrer> $descendants The model's recursive children.
 * @property-read int|null $descendants_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Referrer> $descendantsAndSelf The model's recursive children and itself.
 * @property-read int|null $descendants_and_self_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Referrer> $parentAndSelf The model's direct parent and itself.
 * @property-read int|null $parent_and_self_count
 * @property-read \App\Models\Referrer|null $rootAncestor The model's topmost parent.
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Referrer> $siblings The parent's other children.
 * @property-read int|null $siblings_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Referrer> $siblingsAndSelf All the parent's children.
 * @property-read int|null $siblings_and_self_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Student> $referredStudents
 * @property-read int|null $referred_students_count
 * @property-read \App\Models\Person|null $person
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> all($columns = ['*'])
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Referrer breadthFirst()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Referrer depthFirst()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Referrer doesntHaveChildren()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> get($columns = ['*'])
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Referrer getExpressionGrammar()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Referrer hasChildren()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Referrer hasParent()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Referrer isLeaf()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Referrer isRoot()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Referrer newModelQuery()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Referrer newQuery()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Referrer query()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Referrer tree($maxDepth = null)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Referrer treeOf(\Illuminate\Database\Eloquent\Model|callable $constraint, $maxDepth = null)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Referrer whereCreatedAt($value)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Referrer whereDepth($operator, $value = null)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Referrer whereReferrerId($value)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Referrer whereStudentId($value)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Referrer whereUpdatedAt($value)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Referrer withGlobalScopes(array $scopes)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Referrer withRelationshipExpression($direction, callable $constraint, $initialDepth, $from = null, $maxDepth = null)
 */
	class Referrer extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $report_id
 * @property string $title
 * @property DateTimeImmutable $start_date
 * @property DateTimeImmutable $end_date
 * @property DataCategory $data_category
 * @property FileOutputFormat $file_output_format
 * @property DateTimeImmutable $created_at
 * @property DateTimeImmutable $updated_at
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Report> $children
 * @property-read int|null $children_count
 * @property-read \App\Models\Report|null $parent
 * @property-read int $depth
 * @property-read string $path
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Report> $ancestors The model's recursive parents.
 * @property-read int|null $ancestors_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Report> $ancestorsAndSelf The model's recursive parents and itself.
 * @property-read int|null $ancestors_and_self_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Report> $bloodline The model's ancestors, descendants and itself.
 * @property-read int|null $bloodline_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Report> $childrenAndSelf The model's direct children and itself.
 * @property-read int|null $children_and_self_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Report> $descendants The model's recursive children.
 * @property-read int|null $descendants_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Report> $descendantsAndSelf The model's recursive children and itself.
 * @property-read int|null $descendants_and_self_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Report> $parentAndSelf The model's direct parent and itself.
 * @property-read int|null $parent_and_self_count
 * @property-read \App\Models\Report|null $rootAncestor The model's topmost parent.
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Report> $siblings The parent's other children.
 * @property-read int|null $siblings_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Report> $siblingsAndSelf All the parent's children.
 * @property-read int|null $siblings_and_self_count
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> all($columns = ['*'])
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Report breadthFirst()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Report depthFirst()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Report doesntHaveChildren()
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> get($columns = ['*'])
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Report getExpressionGrammar()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Report hasChildren()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Report hasParent()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Report isLeaf()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Report isRoot()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Report newModelQuery()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Report newQuery()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Report query()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Report tree($maxDepth = null)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Report treeOf(\Illuminate\Database\Eloquent\Model|callable $constraint, $maxDepth = null)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Report whereCreatedAt($value)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Report whereDataCategory($value)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Report whereDepth($operator, $value = null)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Report whereEndDate($value)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Report whereFileOutputFormat($value)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Report whereReportId($value)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Report whereStartDate($value)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Report whereTitle($value)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Report whereUpdatedAt($value)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Report withGlobalScopes(array $scopes)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Report withRelationshipExpression($direction, callable $constraint, $initialDepth, $from = null, $maxDepth = null)
 */
	class Report extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $student_id
 * @property int $person_id
 * @property DateTimeImmutable $created_at
 * @property DateTimeImmutable $updated_at
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Referrer> $asReferrer
 * @property-read int|null $as_referrer_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Student> $children
 * @property-read int|null $children_count
 * @property-read string $formatted_id
 * @property-read string $formatted_student_id
 * @property-read \App\Models\Student|null $parent
 * @property-read \App\Models\Person $person
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Referral> $referrals
 * @property-read int|null $referrals_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Student[] $allActivities
 * @property-read int|null $all_activities_count
 * @property-read int $depth
 * @property-read string $path
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Student> $ancestors The model's recursive parents.
 * @property-read int|null $ancestors_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Student> $ancestorsAndSelf The model's recursive parents and itself.
 * @property-read int|null $ancestors_and_self_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Student> $bloodline The model's ancestors, descendants and itself.
 * @property-read int|null $bloodline_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Student> $childrenAndSelf The model's direct children and itself.
 * @property-read int|null $children_and_self_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Student> $descendants The model's recursive children.
 * @property-read int|null $descendants_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Student> $descendantsAndSelf The model's recursive children and itself.
 * @property-read int|null $descendants_and_self_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Student> $parentAndSelf The model's direct parent and itself.
 * @property-read int|null $parent_and_self_count
 * @property-read \App\Models\Student|null $rootAncestor The model's topmost parent.
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Student> $siblings The parent's other children.
 * @property-read int|null $siblings_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\Student> $siblingsAndSelf All the parent's children.
 * @property-read int|null $siblings_and_self_count
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> all($columns = ['*'])
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Student breadthFirst()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Student depthFirst()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Student doesntHaveChildren()
 * @method static \Database\Factories\StudentFactory factory($count = null, $state = [])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> get($columns = ['*'])
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Student getExpressionGrammar()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Student hasChildren()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Student hasParent()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Student isLeaf()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Student isRoot()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Student newModelQuery()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Student newQuery()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Student query()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Student tree($maxDepth = null)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Student treeOf(\Illuminate\Database\Eloquent\Model|callable $constraint, $maxDepth = null)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Student whereCreatedAt($value)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Student whereDepth($operator, $value = null)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Student wherePersonId($value)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Student whereStudentId($value)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Student whereUpdatedAt($value)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Student withGlobalScopes(array $scopes)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|Student withRelationshipExpression($direction, callable $constraint, $initialDepth, $from = null, $maxDepth = null)
 */
	class Student extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $user_id
 * @property int $person_id
 * @property string $username
 * @property string $password
 * @property string|null $profile_picture
 * @property AccountStatus $account_status
 * @property DateTimeImmutable $created_at
 * @property DateTimeImmutable $updated_at
 * @property string|null $remember_token
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\User> $children
 * @property-read int|null $children_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\User|null $parent
 * @property-read \App\Models\Person $person
 * @property-read int $depth
 * @property-read string $path
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\User> $ancestors The model's recursive parents.
 * @property-read int|null $ancestors_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\User> $ancestorsAndSelf The model's recursive parents and itself.
 * @property-read int|null $ancestors_and_self_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\User> $bloodline The model's ancestors, descendants and itself.
 * @property-read int|null $bloodline_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\User> $childrenAndSelf The model's direct children and itself.
 * @property-read int|null $children_and_self_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\User> $descendants The model's recursive children.
 * @property-read int|null $descendants_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\User> $descendantsAndSelf The model's recursive children and itself.
 * @property-read int|null $descendants_and_self_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\User> $parentAndSelf The model's direct parent and itself.
 * @property-read int|null $parent_and_self_count
 * @property-read \App\Models\User|null $rootAncestor The model's topmost parent.
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\User> $siblings The parent's other children.
 * @property-read int|null $siblings_count
 * @property-read \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, \App\Models\User> $siblingsAndSelf All the parent's children.
 * @property-read int|null $siblings_and_self_count
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> all($columns = ['*'])
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|User breadthFirst()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|User depthFirst()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|User doesntHaveChildren()
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Staudenmeir\LaravelAdjacencyList\Eloquent\Collection<int, static> get($columns = ['*'])
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|User getExpressionGrammar()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|User hasChildren()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|User hasParent()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|User isLeaf()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|User isRoot()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|User newQuery()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|User query()
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|User tree($maxDepth = null)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|User treeOf(\Illuminate\Database\Eloquent\Model|callable $constraint, $maxDepth = null)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|User whereAccountStatus($value)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|User whereDepth($operator, $value = null)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|User wherePersonId($value)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|User whereProfilePicture($value)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|User whereUserId($value)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|User withGlobalScopes(array $scopes)
 * @method static \Staudenmeir\EloquentParamLimitFixXLaravelAdjacencyList\Eloquent\Builder<static>|User withRelationshipExpression($direction, callable $constraint, $initialDepth, $from = null, $maxDepth = null)
 */
	class User extends \Eloquent {}
}

