<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerVxztIOi\srcApp_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerVxztIOi/srcApp_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerVxztIOi.legacy');

    return;
}

if (!\class_exists(srcApp_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerVxztIOi\srcApp_KernelDevDebugContainer::class, srcApp_KernelDevDebugContainer::class, false);
}

return new \ContainerVxztIOi\srcApp_KernelDevDebugContainer([
    'container.build_hash' => 'VxztIOi',
    'container.build_id' => '1aa4c14f',
    'container.build_time' => 1647533666,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerVxztIOi');
