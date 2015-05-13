Views

SELECT `status_tray`.*, `status_stage`.`stage_name`, `status_fiber_type`.`fiber_type_description`
FROM status_tray, status_stage, status_fiber_type
WHERE (`status_tray`.`current_stage_id` = `status_stage`.`id` AND `status_tray`.`fiber_type` = `status_fiber_type`.`id`)
        

SELECT `inv_item`.*, `inv_vendor`.*, `inv_history`.*
FROM inv_item, inv_vendor, inv_history
WHERE (`inv_item`.`current_stage_id` = `status_stage`.`id` AND `status_tray`.`fiber_type` = `status_fiber_type`.`id`)