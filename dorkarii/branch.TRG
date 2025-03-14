TYPE=TRIGGERS
triggers='CREATE DEFINER=`root`@`localhost` TRIGGER generate_branch_id\nBEFORE INSERT ON Branch\nFOR EACH ROW\nBEGIN\n    DECLARE serial_no INT;\n\n    -- Get the current count of entries for the same branch_name\n    SELECT COUNT(*) + 1 INTO serial_no\n    FROM Branch\n    WHERE branch_name = NEW.branch_name;\n\n    -- Generate branch_id using serial_no and branch_name\n    SET NEW.branch_id = CONCAT(serial_no, \'_\', NEW.branch_name);\nEND'
sql_modes=1098907648
definers='root@localhost'
client_cs_names='utf8mb4'
connection_cl_names='utf8mb4_unicode_ci'
db_cl_names='utf8mb4_general_ci'
created=1741979418367748
