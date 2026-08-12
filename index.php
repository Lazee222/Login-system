<?php
header("Location: login.php");
exit();
?>
_______________________________________________________
VALID_INCIDENT_TYPES = [
    "lost id",
    "room issue",
    "lab equipment damage",
    "bullying"
]

ALLOWED_STATUSES = [
    "On Progress",
    "For Review",
    "Completed",
    "Rejected",
    "Needs Revision"
]

reports = []
report_id_counter = 1


def evaluate_initial_status(incident_type, description, priority, has_evidence):
    incident_type = incident_type.strip().lower()
    priority = priority.strip().lower()

    if incident_type not in VALID_INCIDENT_TYPES:
        return "Rejected"

    if len(description.strip()) < 15:
        return "Needs Revision"

    if priority == "high" and has_evidence:
        return "For Review"

    return "On Progress"


def submit_report():
    global report_id_counter

    print("NEW REPORT")

    reporter_name = input("Reporter name: ")
    incident_type = input("Incident type lost id | room issue |lab equipment damage | bullying: ")
    priority = input("Priority (low/medium/high): ")
    description = input("Description: ")
    evidence = input("Evidence attached? (yes/no): ").lower()

    if evidence == "yes":
        has_evidence = True
    else:
        has_evidence = False

    status = evaluate_initial_status(
        incident_type,
        description,
        priority,
        has_evidence
    )

    report = {
        "id": report_id_counter,
        "reporter_name": reporter_name,
        "incident_type": incident_type,
        "priority": priority,
        "description": description,
        "has_evidence": has_evidence,
        "status": status
    }

    reports.append(report)

    print("\nReport submitted successfully.")
    print("Report ID:", report_id_counter)
    print("Status:", status)

    report_id_counter += 1


def review_reports():
    print("ALL RECORDS REPORT")

    if len(reports) == 0:
        print("No reports submitted.")
        return

    for report in reports:
        print("\nReport ID:", report["id"])
        print("Reporter:", report["reporter_name"])
        print("Incident:", report["incident_type"])
        print("Priority:", report["priority"])
        print("Description:", report["description"])
        print("Evidence:", report["has_evidence"])
        print("Status:", report["status"])


def update_report_status():
    print("UPDATING REPORT")

    if len(reports) == 0:
        print("No reports available.")
        return

    for report in reports:
        print(
            report["id"],
            "-",
            report["reporter_name"],
            "-",
            report["status"]
        )

    try:
        target_id = int(input("Enter Report ID: "))
    except ValueError:
        print("Invalid Report ID.")
        return

    selected_report = None

    for report in reports:
        if report["id"] == target_id:
            selected_report = report
            break

    if selected_report is None:
        print("Report ID not found.")
        return

    print("Allowed statuses:")
    print(", ".join(ALLOWED_STATUSES))

    new_status = input("Enter new status: ")

    valid_status = False

    for status in ALLOWED_STATUSES:
        if new_status.lower() == status.lower():
            selected_report["status"] = status
            valid_status = True
            break

    if valid_status:
        print("Status updated successfully.")
    else:
        print("Invalid status.")


def main():
    while True:
        print("INCIDENT REPORT")
        print("1. Submit Report")
        print("2. Review Reports")
        print("3. Update Report Status")
        print("4. Exit")

        choice = input("Choose an option: ")

        if choice == "1":
            submit_report()

        elif choice == "2":
            review_reports()

        elif choice == "3":
            update_report_status()

        elif choice == "4":
            print("Program ended.")
            break

        else:
            print("Invalid choice.")


if __name__ == "__main__":
    main()
