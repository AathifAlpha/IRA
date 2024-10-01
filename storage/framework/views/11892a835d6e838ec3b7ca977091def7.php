
<?php $__env->startSection('content'); ?>
<?php $__env->startSection('responsible'); ?> | Todos Listing <?php $__env->stopSection(); ?>

<div class="row">
    <div class="col-xl-8 col-lg-8 text-end">
        <h3 class="text-end fw-bold"> Medication Error Audit Tool Laravel App </h3>
    </div>
    <div class="col-xl-4 col-lg-4 text-end">
        <a href="javascript:void(0)" id="create-todo-btn" class="btn btn-primary"> Create </a>
    </div>
</div>

<div class="card my-3">
    <table class="table table-striped" id="todo-table">
        <thead class="bg-secondary text-light">
            <tr>
                <th>Id</th>
                <th width="20%">Responsiable Person</th>
                <th width="20%">Employee Name</th>
                <th width="35%">Procedures</th>
                <th width="20%">Action</th>
            <tr>
        </thead>

        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $todos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $todo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr id="todo_<?php echo e($todo->id); ?>">
                    <td><?php echo e($todo->id); ?></td>
                    <td><?php echo e($todo->responsible); ?></td>
                    <td><?php echo e($todo->employee); ?></td>
                    <td><?php echo e($todo->procedures); ?></td>
                    <td>
                        <a href="javascript:void(0)" data-id="<?php echo e($todo->id); ?>" title="View" class="btn btn-sm btn-info btn-view"> View </a>
                        <a href="javascript:void(0)" data-id="<?php echo e($todo->id); ?>" title="Edit" class="btn btn-sm btn-success btn-edit"> Edit </a>
                        <a href="javascript:void(0)" data-id="<?php echo e($todo->id); ?>" title="Delete" class="btn btn-sm btn-danger btn-delete"> Delete </a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5">
                        <p class="text-danger text-center fw-bold"> No data Found! </p>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>


<div class="modal fade" id="todo-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="todoModal" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?php echo e(route('todos.store')); ?>" id="todo-form" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Create Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                        <?php echo csrf_field(); ?>
                        <div class="card">
                            <div class="card-header">
                                <div class="form-group my-3">
                                    <label for="responsible"> Responsible person </label>
                                    <input type="text" required name="responsible" id="responsible"
                                        class="form-control" placeholder="Responsible Person" />
                                </div>


                               
                                
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Employee Name:</strong>
                                        <select name="employee" class="form-control">
                                            <option value="">Select Employee Name</option>
                                            <option value="Mr.Kumar"> Mr.Kumar</option>
                                            <option value="Mr.Anura"> Mr.Anura</option>
                                            <option value="Mr.Sajith"> Mr.Sajith</option>
                                        </select>
                                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="alert alert-danger mt-1 mb-1"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                
                                  
                          

                                <div class="form-group">
                                    <label for="procedures">Procedures</label>
                                    <div id="procedures-checkboxes">
                                        <label><input type="checkbox" name="procedures[]" value="procedures1"> Pushes up sleeves; removes jewelry and watches</label>
                                        <label><input type="checkbox" name="procedures[]" value="procedures2"> Wet hands and wrists under running water, keeping hands lower that wrists and forearms</label>
                                        <label><input type="checkbox" name="procedures[]" value="procedures3"> Avoids splashing water onto clothing </label>
                                        <label><input type="checkbox" name="procedures[]" value="procedures4"> Avoids touching the inside of he sink </label>
                                        <label><input type="checkbox" name="procedures[]" value="procedures5"> Applies liquid soap or sanitizer (3 to 5ml liquid soap) </label>
                                        <label><input type="checkbox" name="procedures[]" value="procedures6"> Rub hands together palm to palm </label>
                                        <label><input type="checkbox" name="procedures[]" value="procedures7"> Right palm over left dorsum with interlaced fingers and vice versa </label>
                                        <label><input type="checkbox" name="procedures[]" value="procedures8"> Back of finger to opposing palms with fingers interlocked </label>
                                        <label><input type="checkbox" name="procedures[]" value="procedures9"> Rotational rubbing of left thumb clasped in in right palm and vice versa </label>
                                        <label><input type="checkbox" name="procedures[]" value="procedures10">Rotational rubbing, backwards and forwards with clasped fingers of right hand in left palm and vice versa </label>
                                        <label><input type="checkbox" name="procedures[]" value="procedures11">Dries hands thoroughly; moves from fingers up to forearms; blots with paper towel Avoids splashing water onto clothing </label>

                                        
                                    </div>
                                </div>

                              
                            </div>
                        </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Aathif\new\resources\views/index.blade.php ENDPATH**/ ?>