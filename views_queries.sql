Views

# view_status_tray
SELECT `status_tray`.*, `status_stage`.`stage_name`, `status_fiber_type`.`fiber_type_description`
FROM status_tray, status_stage, status_fiber_type
WHERE (`status_tray`.`current_stage_id` = `status_stage`.`id` AND `status_tray`.`fiber_type` = `status_fiber_type`.`id`)
        
# view_status_tray_stages
SELECT `status_tray`.*, `status_stage`.`stage_name`, `status_fiber_type`.`fiber_type_description`, `status_tray_stages`.`tray_id`, `status_tray_stages`.`stage_id`
FROM status_tray, status_stage, status_fiber_type, status_tray_stages
WHERE (`status_tray_stages`.`stage_id` = `status_stage`.`id` 
	AND `status_tray`.`fiber_type` = `status_fiber_type`.`id`)

SELECT `status_tray_stages`.*, `status_stage`.`stage_name`, `status_fiber_type`.`fiber_type_description`, `status_tray`.`tray_number`, `status_tray`.`fiber_type`
FROM status_tray_stages
LEFT JOIN status_tray on status_tray_stages.tray_id = status_tray.id
LEFT JOIN status_stage on status_tray_stages.stage_id = status_stage.id
LEFT JOIN status_fiber_type on status_tray.fiber_type = status_fiber_type.id

, status_fiber_type, status_tray_stages
WHERE (`status_tray_stages`.`stage_id` = `status_stage`.`id` 
	AND `status_tray`.`fiber_type` = `status_fiber_type`.`id`)



SELECT `inv_item`.*, `inv_vendor`.*, `inv_history`.*
FROM inv_item, inv_vendor, inv_history
WHERE (`inv_item`.`current_stage_id` = `status_stage`.`id` AND `status_tray`.`fiber_type` = `status_fiber_type`.`id`)