<?php
include 'includes/header.php';
session_start();
$pageTitle = 'Planaluga Contacto';

$errors = [];
$old = [];
$debug_info = '';
$message_sent = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar token CSRF
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
        $errors[] = 'Token de segurança inválido. Por favor, tente novamente.';
    }
    
    // sanitize input
    $old['firstName'] = trim((string)($_POST['firstName'] ?? ''));
    $old['lastName']  = trim((string)($_POST['lastName'] ?? ''));
    $old['email']     = trim((string)($_POST['email'] ?? ''));
    $old['phone']     = trim((string)($_POST['phone'] ?? ''));
    $old['subject']   = trim((string)($_POST['subject'] ?? ''));
    $old['message']   = trim((string)($_POST['message'] ?? ''));
    $privacyCheck     = !empty($_POST['privacyCheck']);
    $old['privacyCheck'] = $privacyCheck;

    // basic validation
    if ($old['firstName'] === '') $errors[] = 'Primeiro nome é obrigatório.';
    if ($old['lastName'] === '') $errors[] = 'Último nome é obrigatório.';
    if ($old['email'] === '' || !filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email inválido.';
    }
    if ($old['subject'] === '') $errors[] = 'Assunto é obrigatório.';
    if ($old['message'] === '') $errors[] = 'Mensagem é obrigatória.';
    if (!$privacyCheck) $errors[] = 'Deve aceitar a Política de Privacidade.';

    // Validação adicional de segurança
    if (strlen($old['firstName']) > 100) $errors[] = 'Primeiro nome muito longo.';
    if (strlen($old['lastName']) > 100) $errors[] = 'Último nome muito longo.';
    if (strlen($old['subject']) > 200) $errors[] = 'Assunto muito longo.';
    if (strlen($old['message']) > 5000) $errors[] = 'Mensagem muito longa.';
    
    $form_submitted = true;
    
    if (empty($errors)) {
        $to = 'tiagomiguel909@gmail.com';
        $email_subject = '[Pedido Orçamento] ' . $old['subject'];
        
        $body = "Pedido de Orçamento\n\n";
        $body .= "Nome: " . $old['firstName'] . ' ' . $old['lastName'] . "\n";
        $body .= "Email: " . $old['email'] . "\n";
        $body .= "Telefone: " . $old['phone'] . "\n";
        $body .= "Assunto: " . $old['subject'] . "\n\n";
        $body .= "Mensagem:\n" . $old['message'] . "\n\n";
      
        $fromEmail = 'planaluga@gmail.com';
        $fromName  = 'Planaluga Website';
        
        // Email headers
        $headers = "From: $fromEmail\r\n";
        $headers .= "Reply-To: $to\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();

        // Additional debug info
        $debug_info .= "To: $to<br>";
        $debug_info .= "Subject:test<br>";
        $debug_info .= "From: $to<br>";
        $debug_info .= "SMTP Server: " . ini_get('SMTP') . "<br>";
        $debug_info .= "SMTP Port: " . ini_get('smtp_port') . "<br>";
        $debug_info .= "Sendmail Path: " . ini_get('sendmail_path') . "<br>";
        
        // Send email
        if (mail($to, $email_subject, $body, $headers)) {
            $message_sent = true;
        } else {
            $error_message = "Failed to send email. Please check your SMTP configuration.";
            // Check if sendmail error log exists
            $error_log_path = "C:\\xampp\\sendmail\\error.log";
            if (file_exists($error_log_path)) {
                $last_errors = file_get_contents($error_log_path);
                $debug_info .= "<br><strong>Last Sendmail Errors:</strong><br>";
                $debug_info .= nl2br(htmlspecialchars(substr($last_errors, -1000))); // Last 1000 chars
            }
            $message_sent = false;
        }
    }
}

?>

<?php if ($message_sent): ?>
    <div role="alert" style="color: #155724;padding: 15px;margin: 20px 0;border: 1px solid #155724;border-radius: 4px;max-width: 50%;margin: 3rem auto 0 auto;text-align: center;">
        ✓ Message sent successfully! Check your email inbox.
    </div>
<?php endif; ?>

<?php if (!empty($error_message)): ?>
    <div role="alert" style="color: red;padding: 15px;margin: 20px 0;border: 1px solid red;border-radius: 4px;max-width: 50%;margin: 3rem auto 0 auto;text-align: center;">
        ✗ <?php echo $error_message; ?>
    </div>
<?php endif; ?>

        <div class="body-wrapper">
            <div class="container my-5">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <h1 class="text-center mb-4">Entre em Contacto</h1>
                        <p class="text-center mb-5">Tem alguma questão ou pretende solicitar um orçamento? Preencha o formulário abaixo e entraremos em contacto consigo brevemente.</p>

                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="firstName" class="form-label">Primeiro Nome</label>
                                    <input name="firstName" type="text" class="form-control" id="firstName" placeholder="Pedro" required maxlength="100" value="<?php echo htmlspecialchars($old['firstName'] ?? ''); ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lastName" class="form-label">Último Nome</label>
                                    <input name="lastName" type="text" class="form-control" id="lastName" placeholder="Silva" required maxlength="100" value="<?php echo htmlspecialchars($old['lastName'] ?? ''); ?>">
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input name="email" type="email" class="form-control" id="email" placeholder="exemplo@email.com" required value="<?php echo htmlspecialchars($old['email'] ?? ''); ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Telefone</label>
                                    <input name="phone" type="tel" class="form-control" id="phone" placeholder="+351 912 345 678" value="<?php echo htmlspecialchars($old['phone'] ?? ''); ?>">
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="subject" class="form-label">Assunto</label>
                                <input name="subject" type="text" class="form-control" id="subject" placeholder="Pedido de Orçamento" required maxlength="200" value="<?php echo htmlspecialchars($old['subject'] ?? ''); ?>">
                            </div>
                            
                            <div class="mb-3">
                                <label for="message" class="form-label">Mensagem</label>
                                <textarea name="message" class="form-control" id="message" rows="5" placeholder="Escreva aqui a sua mensagem..." required maxlength="5000"><?php echo htmlspecialchars($old['message'] ?? ''); ?></textarea>
                            </div>
                            
                            <div class="mb-3 form-check">
                                <input name="privacyCheck" type="checkbox" class="form-check-input" id="privacyCheck" required <?php echo !empty($old['privacyCheck']) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="privacyCheck">
                                    Aceito a <a href="politicatermos.php" target="_blank">Política de Privacidade e Termos de Utilização</a>
                                </label>
                            </div>
                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg px-5">Enviar Mensagem</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>        

<?php include 'includes/footer.php'; ?>