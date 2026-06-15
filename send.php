<?php
// CAST Clinical — contact/intake form handler. Emails submissions to Lynne's inbox.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: contact.html'); exit; }

// Honeypot: bots fill the hidden "website" field.
if (!empty($_POST['website'])) { header('Location: thank-you.html'); exit; }

$to       = 'lynne.castclinical@proton.me';
$fromName = 'CAST Clinical Website';
$fromAddr = 'noreply@castclinical.ca';

$labels = [
  'firstName'   => 'First name',
  'lastName'    => 'Last name',
  'email'       => 'Email',
  'phone'       => 'Phone',
  'contactPref' => 'Preferred contact method',
  'service'     => 'Service',
  'sessionType' => 'Virtual or in-person',
  'concern'     => 'What brings them here',
  'type'        => 'Assessment type',
  'preference'  => 'Preference',
  'message'     => 'Message',
];

$visitor = isset($_POST['email']) ? trim($_POST['email']) : '';
$lines = [];
foreach ($_POST as $k => $v) {
  if ($k === 'website') continue;
  if (is_array($v)) $v = implode(', ', $v);
  $v = trim((string)$v);
  if ($v === '') continue;
  $label = isset($labels[$k]) ? $labels[$k] : ucwords(str_replace(['_', '-'], ' ', $k));
  $lines[] = $label . ': ' . $v;
}

$body  = "New message from your website (castclinical.ca):\n\n";
$body .= implode("\n", $lines);
$body .= "\n\n— Sent " . date('Y-m-d g:i a') . "\n";

$subject = 'New website enquiry — CAST Clinical';
$headers  = 'From: ' . $fromName . ' <' . $fromAddr . ">\r\n";
if (filter_var($visitor, FILTER_VALIDATE_EMAIL)) {
  $headers .= 'Reply-To: ' . $visitor . "\r\n";
}
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

$ok = @mail($to, $subject, $body, $headers);

header('Location: ' . ($ok ? 'thank-you.html' : 'contact.html?err=1'));
exit;
